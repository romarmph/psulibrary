<?php

namespace App\Livewire\Borrower\Books;

use Livewire\Component;
use App\Models\Book;

class BorrowBook extends Component
{
    public $book;

    public function mount($bookId)
    {
        $this->book = Book::find($bookId);
    }

    public function render()
    {
        return view('livewire.borrower.books.borrow-book')->layout('layouts.borrower');
    }
}
