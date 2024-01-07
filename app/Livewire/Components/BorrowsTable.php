<?php

namespace App\Livewire\Components;

use App\Models\BorrowDetail;
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

final class BorrowsTable extends PowerGridComponent
{
  use WithExport;

  public string $primaryKey = 'borrow_details.id';
  public string $sortField = 'borrow_details.id';

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
    return BorrowDetail::query()
      ->join('users', 'users.id', '=', 'borrow_details.borrower_id')
      ->join('borrowed_books', 'borrowed_books.borrow_detail_id', '=', 'borrow_details.id')
      ->join('users as issued_by', 'issued_by.id', '=', 'borrow_details.issued_by')
      ->select([
        'borrow_details.id',
        DB::raw('CONCAT(users.first_name, " ", users.last_name) as borrower'),
        DB::raw('CONCAT(issued_by.first_name, " ", issued_by.last_name) as issued_by'),
        'users.id_number',
        'borrow_details.borrowed_from_date',
        'borrow_details.borrowed_to_date',
        DB::raw('SUM(borrowed_books.quantity) as quantity'),
        DB::raw('COUNT(borrowed_books.book_id) as book_count'),
      ])->groupBy('borrow_details.id', 'users.first_name', 'users.last_name', 'users.id_number', 'borrow_details.borrowed_from_date', 'borrow_details.borrowed_to_date', 'issued_by.first_name', 'issued_by.last_name', 'issued_by.id');
  }

  public function addColumns(): PowerGridColumns
  {
    return PowerGrid::columns()
      ->addColumn('id')
      ->addColumn('borrower')
      ->addColumn('id_number')
      ->addColumn('quantity')
      ->addColumn('book_count')
      ->addColumn('issued_by')
      ->addColumn('borrowed_from_date')
      ->addColumn('borrowed_to_date');
  }

  public function columns(): array
  {
    return [
      Column::make('ID', 'id')
        ->hidden(),

      Column::make('Borrower', 'borrower')
        ->searchable()
        ->sortable(),

      Column::make('ID Number', 'id_number')
        ->searchable()
        ->sortable(),


      Column::make('Quantity', 'quantity'),

      Column::make('Book Count', 'book_count'),

      Column::make('Issued By', 'issued_by')
        ->searchable()
        ->sortable(),

      Column::make('Borrowed From', 'borrowed_from_date')
        ->searchable()
        ->sortable(),

      Column::make('Borrowed To', 'borrowed_to_date')
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

  public function actions(\App\Models\BorrowDetail $row): array
  {
    return [
      Button::add('view')
        ->render(function ($row) {
          return Blade::render(<<<HTML
             <a href="/borrows/$row->id" class="px-2 py-2 text-xs font-bold text-white bg-blue-500 rounded hover:bg-blue-700">View</a>
         HTML);
        }),
    ];
  }

  /*
    public function actionRules(\App\Models\BorrowDetail $row): array
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
