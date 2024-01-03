<?php

namespace App\Livewire\Components;

use App\Models\Book;
use Livewire\Component;

class BooksQuickInfo extends Component
{
  public function render()
  {
    $totalUniqueBooks = Book::count();
    $totalBookCopies = Book::sum('total_copies');
    $totalBooksAvailable = Book::sum('available_copies');
    $totalBooksIssued = $totalBookCopies - $totalBooksAvailable;


    return view(
      'livewire.components.books-quick-info',
      [
        'totalUniqueBooks' => $totalUniqueBooks,
        'totalBookCopies' => $totalBookCopies,
        'totalBooksAvailable' => $totalBooksAvailable,
        'totalBooksIssued' => $totalBooksIssued,
      ],
    );
  }
}
