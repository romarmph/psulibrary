<?php

namespace App\Livewire\Components;

use App\Models\BorrowRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class BorrowerRequestTable extends PowerGridComponent
{
  use WithExport;

  public string $primaryKey = 'borrow_requests.id';
  public string $sortField = 'borrow_requests.id';

  public function setUp(): array
  {
    $this->showCheckBox();

    return [
      Exportable::make('export')
        ->striped()
        ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
      Header::make()->showSearchInput(),
      Footer::make()
        ->showPerPage()
        ->showRecordCount(),
    ];
  }

  public function datasource(): Builder
  {
    $userId = auth()->user()->id;
    return BorrowRequest::query()
      ->join('users', 'borrow_requests.user_id', '=', 'users.id')
      ->join('requested_books', 'borrow_requests.id', '=', 'requested_books.borrow_request_id')
      ->where('borrow_requests.user_id', $userId)
      ->select([
        'borrow_requests.id',
        'borrow_requests.status',
        'borrow_requests.borrow_date as requested_date',
        'borrow_requests.updated_by',
        DB::raw('SUM(requested_books.quantity) as quantity'),
        DB::raw('COUNT(requested_books.book_id) as book_count'),
      ])
      ->groupBy('borrow_requests.id', 'borrow_requests.user_id', 'borrow_requests.status', 'borrow_requests.borrow_date', 'borrow_requests.updated_by');
  }

  public function addColumns(): PowerGridColumns
  {
    return PowerGrid::columns()
      ->addColumn('id')
      ->addColumn('quantity')
      ->addColumn('book_count')
      ->addColumn('requested_date', fn ($row) => $row->requested_date ? Carbon::parse($row->requested_date)->format('M d, Y') : '')
      ->addColumn('status', function ($model) {
        if ($model->status === 'pending') {
          return '<span class="p-1 text-xs font-medium text-blue-500 bg-blue-200 border border-blue-500 rounded-lg">PENDING</span>';
        } else if ($model->status === 'released') {
          return '<span class="p-1 text-xs font-medium text-green-500 bg-green-200 border border-green-500 rounded-lg">RELEASED</span>';
        } else if ($model->status === 'rejected') {
          return '<span class="p-1 text-xs font-medium text-red-500 bg-red-200 border border-red-500 rounded-lg">REJECTED</span>';
        } else {
          return '<span class="p-1 text-xs font-medium text-gray-500 bg-gray-200 border border-gray-500 rounded-lg">CANCELED</span>';
        }
      })
      ->addColumn('updated_by');
  }

  public function columns(): array
  {
    return [
      Column::make('Request ID', 'id')
        ->sortable()
        ->searchable(),

      Column::make('Quantity', 'quantity'),

      Column::make('Book Count', 'book_count'),

      Column::make('Requested Date', 'requested_date')
        ->searchable()
        ->sortable(),

      Column::make('Status', 'status')
        ->searchable()
        ->sortable(),

      Column::make('Updated By', 'updated_by')
        ->searchable()
        ->sortable(),

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('name'),
      Filter::datepicker('created_at_formatted', 'created_at'),
    ];
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  public function actions(\App\Models\BorrowRequest $row): array
  {
    if ($row->status !== 'pending') return [
      Button::add('view')
        ->render(function ($row) {
          return Blade::render(<<<HTML
             <a href="/borrower/requested/$row->id" class="px-2 py-2 text-xs font-bold text-white bg-blue-500 rounded hover:bg-blue-700">View</a>
         HTML);
        }),
    ];

    return [
      Button::add('view')
        ->render(function ($row) {
          return Blade::render(<<<HTML
             <a href="/borrower/requested/$row->id" class="px-2 py-2 text-xs font-bold text-white bg-blue-500 rounded hover:bg-blue-700">View</a>
         HTML);
        }),

      Button::add('cancel')
        ->slot('Cancel')
        ->id('$row->id')
        ->class('bg-red-500 self-start hover:bg-red-700 text-white font-bold py-2 px-2 rounded text-xs')
        ->openModal('modals.cancel-request', ['request_id' => $row->id]),
    ];
  }

  /*
    public function actionRules(\App\Models\Book $row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
