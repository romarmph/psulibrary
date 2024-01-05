<?php

namespace App\Livewire\Borrower\Books;

use Livewire\Component;

class BorrowerBooksPage extends Component
{
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
