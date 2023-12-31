<?php

use App\Livewire\Borrower\Books\BorrowBook;
use App\Livewire\Borrower\Books\BookDetails;
use App\Livewire\Borrower\Books\BorrowerBorrowedPage;
use App\Livewire\Borrower\Books\BorrowerBooksPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Borrower\BorrowerHomePage;
use App\Livewire\Borrower\CartPage;
use App\Livewire\Borrower\Requests\BorrowerRequestPage;
use App\Livewire\Borrower\Requests\BorrowerRequestView;

Route::middleware(['auth', 'role:borrower'])->group(function () {
  Route::get('/borrower', BorrowerHomePage::class)->name('borrower.home');

  Route::get('/borrower/books/', BorrowerBooksPage::class)->name('borrower.books');
  Route::get('/borrower/books/details/{bookId}', BookDetails::class)->name('book.details');
  Route::get('/borrower/books/borrow/{bookId}', BorrowBook::class)->name('book.borrow');

  Route::get('/borrower/borrowed/', BorrowerBorrowedPage::class)
    ->name('borrower.borrowed');
  Route::get('/borrower/requested/', BorrowerRequestPage::class)
    ->name('borrower.requested');

  Route::get('/borrower/requested/{id}', BorrowerRequestView::class)
    ->name('borrower.requested.view');

  Route::get('/borrower/cart', CartPage::class)->name('borrower.cart');
});
