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

final class RequestsTable extends PowerGridComponent
{
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
    return BorrowRequest::query()
      ->join('users', function ($users) {
        $users->on('users.id', '=', 'borrow_requests.user_id');
      })
      ->join('requested_books', function ($requested_books) {
        $requested_books->on('requested_books.borrow_request_id', '=', 'borrow_requests.id');
      })
      ->join('books', function ($books) {
        $books->on('books.id', '=', 'requested_books.book_id');
      })
      ->select([
        'borrow_requests.id',
        'borrow_requests.user_id',
        'borrow_requests.status',
        'borrow_requests.borrow_date as request_date',
        'users.id_number as id_number',
        DB::raw('CONCAT(users.first_name, " ", users.last_name) as name'),
        DB::raw('SUM(requested_books.quantity) as quantity'),
        DB::raw('COUNT(requested_books.book_id) as book_count'),
      ])
      ->groupBy('borrow_requests.id', 'borrow_requests.status', 'borrow_requests.user_id', 'borrow_requests.created_at', 'borrow_requests.updated_at', 'users.first_name', 'borrow_requests.status', 'borrow_requests.borrow_date', 'borrow_requests.return_date', 'users.last_name', 'users.id_number');
  }

  public function addColumns(): PowerGridColumns
  {
    return PowerGrid::columns()
      ->addColumn('id')
      ->addColumn('id_number')
      ->addColumn('name')
      ->addColumn('status', function ($model) {
        if ($model->status === 'pending') {
          return '<span class="p-1 text-blue-500 bg-blue-200 border border-blue-500 rounded-lg">PENDING</span>';
        } else if ($model->status === 'released') {
          return '<span class="p-1 text-green-500 bg-green-200 border border-green-500 rounded-lg">RELEASED</span>';
        } else if ($model->status === 'rejected') {
          return '<span class="p-1 text-red-500 bg-red-200 border border-red-500 rounded-lg">REJECTED</span>';
        } else {
          return '<span class="p-1 text-gray-500 bg-gray-200 border border-gray-500 rounded-lg">CANCELED</span>';
        }
      })
      ->addColumn('name_lower', fn (BorrowRequest $model) => strtolower(e($model->name)))
      ->addColumn('request_date_formatted', fn (BorrowRequest $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
  }

  public function columns(): array
  {
    return [
      Column::make('ID', 'id')
        ->hidden(),

      Column::make('ID Number', 'id_number')
        ->searchable()
        ->sortable(),

      Column::make('Requested By', 'name')
        ->searchable()
        ->sortable(),

      Column::make('Status', 'status')
        ->searchable()
        ->sortable(),

      Column::make('Quantity', 'quantity')
        ->searchable()
        ->sortable(),

      Column::make('No. Books', 'book_count')
        ->searchable()
        ->sortable(),

      Column::make('Request Date', 'request_date_formatted', 'request_date')
        ->searchable(),

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



  public function actions(\App\Models\BorrowRequest $row): array
  {
    if ($row->status !== 'pending') return [];

    return [
      Button::add('view')
        ->render(function ($staff) {
          return Blade::render(<<<HTML
             <a href="/requests/$staff->id" class="px-2 py-2 text-xs font-bold text-white bg-blue-500 rounded hover:bg-blue-700">View</a>
         HTML);
        }),

      Button::add('reject')
        ->slot('Reject')
        ->id('$row->id')
        ->class('bg-red-500 self-start hover:bg-red-700 text-white font-bold py-2 px-2 rounded text-xs')
        ->openModal('modals.reject-request', ['request_id' => $row->id]),
    ];
  }
}
