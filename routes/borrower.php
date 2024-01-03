<?php

use App\Livewire\Borrower\Books\BorrowerBooksPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Borrower\BorrowerHomePage;


Route::middleware(['auth', 'role:borrower'])->group(function () {
  Route::get('/borrower', BorrowerHomePage::class)->name('borrower.home');

  Route::get('/borrower/books/', BorrowerBooksPage::class)->name('borrower.books');
});
