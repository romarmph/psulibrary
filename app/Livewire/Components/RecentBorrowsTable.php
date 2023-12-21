<?php

namespace App\Livewire\Components;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RecentBorrowsTable extends Component
{
  use WithPagination;

  public $perPage = 10;
  public $search = '';
  public $category = 0;

  public function render()
  {
    $bookCategories = Category::all();
    $borrows = DB::table('borrowed_books')
      ->join('borrow_details', 'borrow_details.id', '=', 'borrowed_books.borrow_detail_id')
      ->join('books', 'books.id', '=', 'borrowed_books.book_id')
      ->join('users', 'users.id', '=', 'borrow_details.issued_by')
      ->join('categories', 'categories.id', '=', 'books.category_id')
      ->select(
        'users.id_number',
        'users.first_name',
        'users.last_name',
        'books.title',
        'books.isbn',
        'categories.name as category',
        'borrowed_books.quantity',
        'borrow_details.borrowed_from_date',
        'borrow_details.borrowed_to_date',
      )
      ->where('borrow_details.borrowed_from_date', '>=', now()->subDays(7))
      ->where('books.title', 'like', '%' . $this->search . '%')
      ->orWhere('books.isbn', 'like', '%' . $this->search . '%')
      ->orWhere('users.first_name', 'like', '%' . $this->search . '%')
      ->orWhere('users.last_name', 'like', '%' . $this->search . '%')
      ->orWhere('users.id_number', 'like', '%' . $this->search . '%')
      ->orderBy('borrow_details.borrowed_from_date', 'desc');



    if ($this->category != 0) {
      $borrows = $borrows->where('books.category_id', '=', $this->category);
    }

    $borrows = $borrows->paginate($this->perPage);

    return view(
      'livewire.components.recent-borrows-table',
      [
        'borrows' => $borrows,
        'categories' => $bookCategories,
      ],
    );
  }
}
