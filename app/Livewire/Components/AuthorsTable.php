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

final class AuthorsTable extends PowerGridComponent
{
  use WithExport;

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
    return DB::table('authors');
  }

  public function addColumns(): PowerGridColumns
  {
    return PowerGrid::columns()
      ->addColumn('id')
      ->addColumn('name')

      /** Example of custom column using a closure **/
      ->addColumn('name_lower', fn ($model) => strtolower(e($model->name)))

      ->addColumn('created_by')
      ->addColumn('updated_by')

      ->addColumn('created_at_formatted', fn ($model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
      ->addColumn('updated_at_formatted', fn ($model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
  }

  public function columns(): array
  {
    return [
      Column::make('Id', 'id'),
      Column::make('Name', 'name')
        ->sortable()
        ->searchable(),

      Column::make('Created by', 'created_by'),
      Column::make('Updated by', 'updated_by'),


      Column::make('Created at', 'created_at_formatted', 'created_at')
        ->sortable(),

      Column::make('Updated at', 'updated_at_formatted', 'updated_at')
        ->sortable(),

      Column::action('Actions'),

    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('name')->operators(['contains']),
      Filter::datetimepicker('deleted_at'),
      Filter::datetimepicker('created_at'),
      Filter::datetimepicker('updated_at'),
    ];
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  public function actions($row): array
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
