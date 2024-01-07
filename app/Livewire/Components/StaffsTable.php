<?php

namespace App\Livewire\Components;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Blade;
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

final class StaffsTable extends PowerGridComponent
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
        return DB::table('users')
        ->where('role', 'staff');
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('first_name')

           /** Example of custom column using a closure **/
            ->addColumn('first_name_lower', fn ($model) => strtolower(e($model->first_name)))

            ->addColumn('last_name')
            ->addColumn('id_number')
            ->addColumn('email')
            ->addColumn('phone_number')
            ->addColumn('address')
            ->addColumn('photo_url')
            ->addColumn('password')
            ->addColumn('role')
            ->addColumn('course_id')
            ->addColumn('created_by')
            ->addColumn('updated_by')
            ->addColumn('deleted_at_formatted', fn ($model) => Carbon::parse($model->deleted_at)->format('d/m/Y H:i:s'))
            ->addColumn('remember_token')
            ->addColumn('created_at_formatted', fn ($model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn ($model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('First name', 'first_name')
                ->sortable()
                ->searchable(),

            Column::make('Last name', 'last_name')
                ->sortable()
                ->searchable(),

            Column::make('Id number', 'id_number')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Phone number', 'phone_number')
                ->sortable()
                ->searchable(),

            Column::make('Address', 'address')
                ->sortable()
                ->searchable(),

            Column::make('Photo url', 'photo_url')
                ->sortable()
                ->searchable(),

            Column::make('Password', 'password')
                ->sortable()
                ->searchable(),

            Column::make('Role', 'role')
                ->sortable()
                ->searchable(),

            Column::make('Course id', 'course_id'),
            Column::make('Created by', 'created_by'),
            Column::make('Updated by', 'updated_by'),
            Column::make('Deleted at', 'deleted_at_formatted', 'deleted_at')
                ->sortable(),

            Column::make('Remember token', 'remember_token')
                ->sortable()
                ->searchable(),

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
            Filter::inputText('first_name')->operators(['contains']),
            Filter::inputText('last_name')->operators(['contains']),
            Filter::inputText('id_number')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            Filter::inputText('phone_number')->operators(['contains']),
            Filter::inputText('address')->operators(['contains']),
            Filter::inputText('photo_url')->operators(['contains']),
            Filter::inputText('password')->operators(['contains']),
            Filter::inputText('role')->operators(['contains']),
            Filter::datetimepicker('deleted_at'),
            Filter::inputText('remember_token')->operators(['contains']),
            Filter::datetimepicker('created_at'),
            Filter::datetimepicker('updated_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions($row): array
    {
        return [
            Button::add('delete')
            ->slot('Delete')
            ->id()
            ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded text-xs')
            ->openModal('modals.delete-book', ['Staff_id' => $row->id]),

            Button::add('edit')
        ->render(function ($staff) {
          return Blade::render(<<<HTML
       <a href="/staffs/edit/$staff->id" class="px-2 py-2 text-xs font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Edit</a>
   HTML);
        }),
            // Button::add('edit')
            //     ->slot('Edit: '.$row->id)
            //     ->id()
            //     ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
            //     ->dispatch('edit', ['rowId' => $row->id])
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
