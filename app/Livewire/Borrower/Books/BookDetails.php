<?php

namespace App\Livewire\Borrower\Books;

use Livewire\Component;
use App\Models\Book;

class BookDetails extends Component
{
    
      
    public $book;

    public function mount($bookId)
    {
        // Fetch book details based on the provided $bookId
        $this->book = Book::find($bookId);
    }

    public function render()
    {
        return view('livewire.borrower.books.book-details')->layout('layouts.borrower');
    }
}
