<?php

namespace App\Livewire\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\BorrowRequest;
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

final class RequestedTable extends PowerGridComponent
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
        $userId = auth()->id();
    
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
                'books.id as book_id', 
                DB::raw('SUM(requested_books.quantity) as quantity'),
                DB::raw('COUNT(requested_books.book_id) as book_count'),
            ])
            ->where('borrow_requests.user_id', $userId)
            ->groupBy(
                'borrow_requests.id',
                'borrow_requests.status',
                'borrow_requests.user_id',
                'borrow_requests.created_at',
                'borrow_requests.updated_at',
                'users.first_name',
                'borrow_requests.status',
                'borrow_requests.borrow_date',
                'borrow_requests.return_date',
                'users.last_name',
                'users.id_number',
                'books.id'
            );
    }
    

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('book_id')
            ->addColumn('borrow_request_id')
            ->addColumn('quantity');
    }

    public function columns(): array
    {
        return [
            Column::make('Book id', 'book_id'),
            Column::make('Borrow request id', 'id'),
            Column::make('Quantity', 'quantity'),
            Column::action('Actions'),
        ];
    }

    public function filters(): array
    {
        return [
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
            Button::add('edit')
                ->slot('Edit: '.$row->id)
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
