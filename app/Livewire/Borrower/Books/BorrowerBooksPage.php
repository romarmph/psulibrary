<?php

namespace App\Livewire\Borrower\Books;

use Livewire\Component;

class BorrowerBooksPage extends Component
{
  public function render()
  {
    $user = auth()->user();
    return view('livewire.borrower.books.borrower-books-page', [
      'user' => $user,
    ],)->layout('layouts.borrower');
  }
}
