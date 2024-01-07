<?php

namespace App\Livewire\Borrower;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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

final class BorrowedBooksTable extends PowerGridComponent
{
  public string $primaryKey = 'books.id';
  public string $sortField = 'books.id';

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

    return Book::query()
      ->join('borrowed_books', 'books.id', '=', 'borrowed_books.book_id')
      ->join('borrow_details', 'borrowed_books.borrow_detail_id', '=', 'borrow_details.id')
      ->join('users as issued_by', 'borrow_details.issued_by', '=', 'issued_by.id')
      ->leftJoin('users as received_by', 'borrowed_books.received_by', '=', 'received_by.id')
      ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
      ->join('categories', 'books.category_id', '=', 'categories.id')
      ->where('borrow_details.borrower_id', $userId)
      ->select([
        'books.id as id',
        'books.title as title',
        'books.isbn as isbn',
        'borrowed_books.quantity as quantity',
        'borrow_details.borrowed_from_date as date_borrowed',
        'borrowed_books.returned_at as date_returned',
        DB::raw('CONCAT(issued_by.first_name, " ", issued_by.last_name) as released_by'),
        DB::raw('CONCAT(received_by.first_name, " ", received_by.last_name) as received_by'),
        'publishers.name as publisher',
        'categories.name as category',
        'books.photo_url as photo_url'
      ]);
  }


  public function addColumns(): PowerGridColumns
  {
    return PowerGrid::columns()
      ->addColumn('id')
      ->addColumn('title')
      ->addColumn('isbn')
      ->addColumn('quantity')
      ->addColumn('category')
      ->addColumn('publisher')
      ->addColumn('released_by')
      ->addColumn('date_borrowed', fn ($model) => Carbon::parse($model->date_borrowed)->format('M d, Y'))
      ->addColumn('date_returned', fn ($model) => $model->date_returned ? Carbon::parse($model->date_returned)->format('M d, Y') : '')
      ->addColumn('received_by')
      ->addColumn('status', function ($model) {
        if ($model->date_returned) {
          return '<span class="p-1 text-xs text-green-500 bg-green-200 border border-green-500 rounded-lg">Returned</span>';
        } else {
          return '<span class="p-1 text-xs text-red-500 bg-red-200 border border-red-500 rounded-lg">Unreturned</span>';
        }
      })
      ->addColumn('photo_url', fn ($model) => '<img src="' . $model->photo_url . '" class="object-cover w-12 h-12 rounded-full" alt="photo_url">');
  }

  public function columns(): array
  {
    return [
      Column::make('ID', 'id')
        ->hidden(),

      Column::make('Photo url', 'photo_url'),
      Column::make('Title', 'title')
        ->searchable()
        ->sortable(),

      Column::make('ISBN', 'isbn')
        ->searchable()
        ->sortable(),

      Column::make('PUBLISHER', 'publisher')
        ->searchable()
        ->sortable(),

      Column::make('CATEGORY', 'category')
        ->searchable()
        ->sortable(),

      Column::make('Quantity', 'quantity')
        ->sortable(),

      Column::make('Status', 'status')
        ->sortable(),

      Column::make('Released by', 'released_by')
        ->searchable()
        ->sortable(),

      Column::make('Date borrowed', 'date_borrowed')
        ->searchable()
        ->sortable(),

      Column::make('Date returned', 'date_returned')
        ->searchable()
        ->sortable(),

      Column::make('Received by', 'received_by')
        ->searchable()
        ->sortable(),



      // Column::action('Action')
    ];
  }

  // public function filters(): array
  // {
  //   return [
  //     Filter::inputText('name'),
  //     Filter::datepicker('created_at_formatted', 'created_at'),
  //   ];
  // }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  // public function actions(\App\Models\Book $row): array
  // {
  //   return [
  //     Button::add('edit')
  //       ->slot('Edit: ' . $row->id)
  //       ->id()
  //       ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
  //       ->dispatch('edit', ['rowId' => $row->id])
  //   ];
  // }

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
