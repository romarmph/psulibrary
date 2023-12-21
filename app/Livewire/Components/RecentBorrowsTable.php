<?php

namespace App\Livewire\Components;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RecentBorrowsTable extends Component
{
  use WithPagination;

  public $perPage = 10;

  public function render()
  {
    $borrows = DB::table('borrowed_books')
      ->join('borrow_details', 'borrow_details.id', '=', 'borrowed_books.borrow_detail_id')
      ->join('books', 'books.id', '=', 'borrowed_books.book_id')
      ->join('users', 'users.id', '=', 'borrow_details.issued_by')
      ->select(
        'users.first_name',
        'users.last_name',
        'books.title',
        'books.isbn',
        'borrowed_books.quantity',
        'borrow_details.borrowed_from_date',
        'borrow_details.borrowed_to_date',
      )
      ->where('borrow_details.borrowed_from_date', '>=', now()->subDays(3))
      ->orderBy('borrow_details.borrowed_from_date', 'desc')
      ->paginate(10);

    dd($borrows);
    return view(
      'livewire.components.recent-borrows-table',
      [
        'borrows' => $borrows,
      ],
    );
  }
}
