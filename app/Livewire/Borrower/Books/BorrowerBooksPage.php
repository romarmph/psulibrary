<?php

namespace App\Livewire\Borrower\Books;

use Livewire\Component;

class BorrowerBooksPage extends Component
{
  public $category;
  public $search;
  public $limit = 15;
  public $sortField = 'title:asc';

  public function render()
  {
    $books = \App\Models\Book::paginate(15);

    $user = auth()->user();
    return view('livewire.borrower.books.borrower-books-page', [
      'user' => $user,
      'books' => $books,
    ],)->layout('layouts.borrower');
  }
}
