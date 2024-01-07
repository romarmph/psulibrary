<?php

namespace App\Livewire\Components;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class BorrowsViewBooksTable extends PowerGridComponent
{
  use WithExport;
  // public string $primaryKey = 'books.id';
  public string $sortField = 'books.id';

  public $borrowId;


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
    return DB::table('books')
      ->join('borrowed_books', 'books.id', '=', 'borrowed_books.book_id')
      ->join('borrow_details', 'borrowed_books.borrow_detail_id', '=', 'borrow_details.id')
      ->join('users as issued_by', 'borrow_details.issued_by', '=', 'issued_by.id')
      ->leftJoin('users as received_by', 'borrowed_books.received_by', '=', 'received_by.id')
      ->where('borrow_details.id', $this->borrowId)
      ->select(
        [
          'books.id',
          'books.photo_url',
          'books.title',
          'books.isbn',
          'borrowed_books.quantity',
          DB::raw('CONCAT(issued_by.first_name, " ", issued_by.last_name) as issued_by'),
          DB::raw('CONCAT(received_by.first_name, " ", received_by.last_name) as received_by'),
          'borrow_details.borrowed_from_date',
          'borrow_details.borrowed_to_date',
          'borrowed_books.returned_at'
        ]
      );
  }

  public function addColumns(): PowerGridColumns
  {
    return PowerGrid::columns()
      ->addColumn('id')
      ->addColumn('photo_url', fn ($row) => '<img src="' . $row->photo_url . '" class="w-12 h-12 rounded-full" />')
      ->addColumn('title')
      ->addColumn('isbn')
      ->addColumn('quantity')
      ->addColumn('status', function ($row) {
        if ($row->returned_at === null) {
          return '<span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-500 bg-red-200 border border-red-500 rounded-full b">
          Unreturned
        </span>';
        } else {
          return '<span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-500 bg-green-200 border border-green-500 rounded-full b">
          Returned
        </span>';
        }
      })
      ->addColumn('issued_by')
      ->addColumn('received_by')
      ->addColumn('borrowed_from_date', fn ($row) => $row->borrowed_from_date ? Carbon::parse($row->borrowed_from_date)->format('M d, Y') : "")
      ->addColumn('borrowed_to_date', fn ($row) => $row->borrowed_to_date ? Carbon::parse($row->borrowed_to_date)->format('M d, Y') : "")
      ->addColumn('returned_at', fn ($row) => $row->returned_at ? Carbon::parse($row->returned_at)->format('M d, Y') : "");
  }

  public function columns(): array
  {
    return [
      Column::make('ID', 'id')
        ->hidden(),

      Column::make('Photo', 'photo_url'),

      Column::make('Title', 'title')
        ->searchable()
        ->sortable(),

      Column::make('ISBN', 'isbn')
        ->searchable()
        ->sortable(),

      Column::make('Quantity', 'quantity'),

      Column::make('Status', 'status')
        ->searchable()
        ->sortable(),

      Column::make('Issued By', 'issued_by')
        ->searchable()
        ->sortable(),

      Column::make('Borrowed From', 'borrowed_from_date')
        ->sortable(),

      Column::make('Borrowed To', 'borrowed_to_date')
        ->sortable(),

      Column::make('Received By', 'received_by')
        ->searchable()
        ->sortable(),

      Column::make('Returned At', 'returned_at')
        ->sortable(),

      Column::action('Actions'),
    ];
  }

  public function filters(): array
  {
    return [
      Filter::boolean('quantity'),
      Filter::datetimepicker('returned_at'),
    ];
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  public function actions($row): array
  {
    if ($row->received_by) {
      return [];
    }

    return [
      Button::add('return')
        ->slot('Return')
        ->id('$row->id')
        ->class('bg-green-500 self-start hover:bg-green-700 text-white font-bold py-2 px-2 rounded text-xs')
        ->openModal(
          'modals.return-book',
          [
            'book_id' => $row->id,
            'borrow_id' => $this->borrowId,
          ]
        ),
    ];
  }

  /*
    public function actionRules($row): array
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
