<?php

namespace App\Livewire\Borrower\Books;

use Livewire\Component;

class BorrowerBorrowedPage extends Component
{
  public function render()
  {
    $user = auth()->user();
    return view('livewire.borrower.books.borrower-borrowed-page', [
      'user' => $user,
    ],)->layout('layouts.borrower');
  }
}
