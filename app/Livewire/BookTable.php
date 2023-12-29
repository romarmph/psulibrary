<?php

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

final class BookTable extends PowerGridComponent
{
  use WithExport;

  public function setUp(): array
  {
    $this->showCheckBox();

    return [
      Exportable::make('books-export')
        ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
      Header::make()->showSearchInput(),
      Footer::make()
        ->showPerPage()
        ->showRecordCount(),
    ];
  }

  public function datasource(): Builder
  {
    return Book::query();
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function addColumns(): PowerGridColumns
  {
    return PowerGrid::columns()
      ->addColumn('id')
      ->addColumn('title')

      /** Example of custom column using a closure **/
      ->addColumn('title_lower', fn (Book $model) => strtolower(e($model->title)))

      ->addColumn('isbn')
      ->addColumn('description')
      ->addColumn('category_id')
      ->addColumn('publisher_id')
      ->addColumn('published_at_formatted', fn (Book $model) => Carbon::parse($model->published_at)->format('d/m/Y'))
      ->addColumn('total_copies')
      ->addColumn('available_copies')
      ->addColumn('photo_url')
      ->addColumn('created_by')
      ->addColumn('updated_by')
      ->addColumn('created_at_formatted', fn (Book $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
  }

  public function columns(): array
  {
    return [
      Column::make('Id', 'id'),
      Column::make('Title', 'title')
        ->sortable()
        ->searchable(),

      Column::make('Isbn', 'isbn'),
      Column::make('Description', 'description')
        ->sortable()
        ->searchable(),

      Column::make('Category id', 'category_id'),
      Column::make('Publisher id', 'publisher_id'),
      Column::make('Published at', 'published_at_formatted', 'published_at')
        ->sortable(),

      Column::make('Total copies', 'total_copies'),

      Column::make('Available copies', 'available_copies'),

      Column::make('Photo url', 'photo_url')
        ->sortable()
        ->searchable(),

      Column::make('Created by', 'created_by'),
      Column::make('Updated by', 'updated_by'),
      Column::make('Created at', 'created_at_formatted', 'created_at')
        ->sortable(),

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('title')->operators(['contains']),
      Filter::inputText('description')->operators(['contains']),
      Filter::datepicker('published_at'),

      Filter::inputText('photo_url')->operators(['contains']),
      Filter::datetimepicker('created_at'),
    ];
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  public function actions(\App\Models\Book $row): array
  {
    return [
      Button::add('edit')
        ->slot('Edit: ' . $row->id)
        ->id()
        ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
        ->dispatch('edit', ['rowId' => $row->id])
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
