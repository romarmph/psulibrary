<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Book;
use App\Models\BorrowDetail;
use App\Models\BorrowedBooks;
use Illuminate\Support\Facades\DB;

class DashboardQuickInfo extends Component
{


  public function render()
  {
    $totalUniqueBooks = Book::count();
    $totalBookCopies = Book::sum('total_copies');
    $totalBooksAvailable = Book::sum('available_copies');
    $totalBooksIssued = $totalBookCopies - $totalBooksAvailable;

    $totalBorrowers = BorrowDetail::where('borrowed_from_date', '<=', now())
      ->where('borrowed_to_date', '>=', now())
      ->count();

    $totalBorrowersWithUnreturnedBooks = DB::table('borrowed_books')
      ->join('borrow_details', 'borrowed_books.borrow_detail_id', '=', 'borrow_details.id')
      ->whereNull('borrowed_books.returned_at')
      ->distinct('borrow_details.borrower_id')
      ->count('borrow_details.borrower_id');

    $totalUnreturnedBooks = DB::table('borrowed_books')
      ->whereNull('returned_at')
      ->sum('quantity');

    $totalBooksDueToday = DB::table('borrowed_books')
      ->join('borrow_details', 'borrowed_books.borrow_detail_id', '=', 'borrow_details.id')
      ->whereNull('borrowed_books.returned_at')
      ->whereDate('borrow_details.borrowed_to_date', '=', now()->toDateString())
      ->sum('borrowed_books.quantity');

    $totalBorrowersWithBooksDueToday = DB::table('borrowed_books')
      ->join('borrow_details', 'borrowed_books.borrow_detail_id', '=', 'borrow_details.id')
      ->whereNull('borrowed_books.returned_at')
      ->whereDate('borrow_details.borrowed_to_date', '=', now()->toDateString())
      ->distinct('borrow_details.borrower_id')
      ->count('borrow_details.borrower_id');

    return view(
      'livewire.components.dashboard-quick-info',
      [
        'totalUniqueBooks' => $totalUniqueBooks,
        'totalBookCopies' => $totalBookCopies,
        'totalBooksAvailable' => $totalBooksAvailable,
        'totalBooksIssued' => $totalBooksIssued,
        'totalBorrowers' => $totalBorrowers,
        'totalBorrowersWithUnreturnedBooks' => $totalBorrowersWithUnreturnedBooks,
        'totalUnreturnedBooks' => $totalUnreturnedBooks,
        'totalBooksDueToday' => $totalBooksDueToday,
        'totalBorrowersWithBooksDueToday' => $totalBorrowersWithBooksDueToday,

      ],
    );
  }
}
