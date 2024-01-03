<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AdminHomePage;
use App\Livewire\Admin\BooksPage;

Route::middleware(['auth', 'role:staff'])->group(function () {
  Route::get('/admin', AdminHomePage::class)->name('admin.home');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/books', BooksPage::class)->middleware('auth')->name('books.index');

Route::middleware(['auth', 'role:staff'])->group(function () {
  Route::get('/books/create', BooksPage::class)->name('books.create');
  Route::get('/books/edit/{id}', BooksPage::class)->name('books.edit');
  Route::get('/books/destroy/{id}', BooksPage::class)->name('books.delete');
});
