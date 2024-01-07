<?php

namespace App\Livewire\Components;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
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

final class BooksTable extends PowerGridComponent
{
  use WithExport;

  protected $listeners = ['bookCreated' => '$refresh'];

  public function setUp(): array
  {
    $this->showCheckBox();

    return [
      Exportable::make('export')
        ->striped()
        ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
      Header::make()->showSearchInput()->showToggleColumns(),
      Footer::make()
        ->showPerPage()
        ->showRecordCount(),
    ];
  }

  public function datasource(): Builder
  {

    return DB::table('books')
      ->join('categories', 'books.category_id', '=', 'categories.id')
      ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
      ->join('users as created_by', 'books.created_by', '=', 'created_by.id')
      ->join('users as updated_by', 'books.updated_by', '=', 'updated_by.id')
      ->whereNull('books.deleted_at')
      ->select('books.id', 'books.photo_url', 'books.isbn', 'books.title', 'books.total_copies', 'books.available_copies', 'categories.name as category', 'books.created_at', 'books.updated_at', 'publishers.name as publisher', DB::raw('CONCAT(created_by.first_name, " ", created_by.last_name) as created_by'), DB::raw('CONCAT(updated_by.first_name, " ", updated_by.last_name) as updated_by'), 'books.published_at');
  }

  public function addColumns(): PowerGridColumns
  {
    return PowerGrid::columns()
      ->addColumn('id')
      ->addColumn('isbn')
      ->addColumn('title')

      /** Example of custom column using a closure **/
      ->addColumn('title_lower', fn ($model) => strtolower(e($model->title)))

      ->addColumn('category')
      ->addColumn('publisher')
      ->addColumn('published_at',)
      ->addColumn('total_copies')
      ->addColumn('available_copies')
      ->addColumn('photo_url', fn ($model) => '<img src="' . $model->photo_url . '" class="object-cover w-10 h-10 rounded-full" alt="photo_url">')
      ->addColumn('created_by')
      ->addColumn('updated_by')
      ->addColumn('created_at_formatted', fn ($model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
      ->addColumn('updated_at_formatted', fn ($model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
  }

  public function columns(): array
  {
    return [
      // Column::make('id', 'id'),
      Column::make('Photo url', 'photo_url'),
      Column::make('Isbn', 'isbn'),
      Column::make('Title', 'title')
        ->sortable()
        ->searchable(),


      Column::make('Category', 'category')->sortable(),
      Column::make('Publisher', 'publisher')->sortable(),
      Column::make('Published at', 'published_at')
        ->sortable(),

      Column::make('Total copies', 'total_copies'),

      Column::make('Available copies', 'available_copies'),


      Column::make('Created by', 'created_by'),
      Column::make('Updated by', 'updated_by'),


      Column::make('Created at', 'created_at_formatted', 'created_at')
        ->sortable(),

      Column::make('Updated at', 'updated_at_formatted', 'updated_at')
        ->sortable(),

      Column::action('Action', 'id')

    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('title')->operators(['contains']),
      Filter::inputText('isbn')->operators(['contains']),
      Filter::inputText('description')->operators(['contains']),
      Filter::inputText('description')->operators(['contains']),
      Filter::select('published_at')->dataSource(Book::years())->optionValue('code')->optionLabel('value'),
      Filter::inputText('total_copies')->operators(['is']),
      Filter::inputText('available_copies')->operators(['is']),
      Filter::datetimepicker('deleted_at_formatted', 'books.deleted_at'),
      Filter::datetimepicker('created_at_formatted', 'books.created_at'),
      Filter::datetimepicker('updated_at_formatted', 'books.updated_at'),
    ];
  }



  public function actions($row): array
  {
    return [
      Button::add('delete')
        ->slot('Delete')
        ->id()
        ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded text-xs')
        ->openModal('modals.delete-book', ['book_id' => $row->id]),
      // Button::add('edit')
      //   ->slot('Edit')
      //   ->id()
      //   ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded text-xs')
      //   ->route('books.edit', ['id' => $row->id])
      //   ->target('_self'),
      Button::add('edit')
        ->render(function ($book) {
          return Blade::render(<<<HTML
       <a href="/books/edit/$book->id" class="px-2 py-2 text-xs font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Edit</a>
   HTML);
        }),
      Button::add('view')
        ->render(function ($book) {
          return Blade::render(<<<HTML
       <a href="/books/view/$book->id" class="px-2 py-2 text-xs font-bold text-white bg-green-500 rounded hover:bg-green-700">View</a>
   HTML);
        }),
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
