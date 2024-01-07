<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AdminHomePage;
use App\Livewire\Admin\Authors\AuthorsPage;
use App\Livewire\Admin\Publishers\PublishersPage;
use App\Livewire\Admin\Staffs\StaffsPage;
use App\Livewire\Admin\Staffs\StaffCreatePage;
use App\Livewire\Admin\BookCreateForm;
use App\Livewire\Admin\BookCreatePage;
use App\Livewire\Admin\BookEditForm;
use App\Livewire\Admin\BooksPage;
use App\Livewire\Admin\Borrows\BorrowsPage;
use App\Livewire\Admin\Borrows\BorrowsView;
use App\Livewire\Admin\Requests\RequestPage;
use App\Livewire\Admin\Requests\RequestView;
use App\Livewire\Borrower\Books\RequestPage as BooksRequestPage;

Route::middleware(['auth', 'role:staff'])->group(function () {
  Route::get('/admin', AdminHomePage::class)->name('admin.home');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/books', BooksPage::class)->middleware(['auth', 'role:staff'])->name('books.index');

Route::middleware(['auth', 'role:staff'])->group(function () {
  Route::get('/books/create', BookCreateForm::class)->name('books.create');
  Route::get('/books/edit/{id}', BookCreateForm::class)->name('books.edit');
  Route::get('/books/destroy/{id}', BooksPage::class)->name('books.delete');
});

Route::get('/authors', AuthorsPage::class)->middleware(['auth', 'role:staff'])->name('authors.index');
Route::get('/authors/destroy/{id}', AuthorsPage::class)->middleware(['auth', 'role:staff'])->name('authors.delete');
Route::get('/authors/edit/{id}', AuthorsPage::class)->middleware(['auth', 'role:staff'])->name('authors.edit');

Route::get('/publishers', PublishersPage::class)->middleware(['auth', 'role:staff'])->name('publishers.index');
Route::get('/publishers/edit/{id}', PublishersPage::class)->middleware(['auth', 'role:staff'])->name('publishers.edit');
Route::get('/publisher/destroy/{id}', PublishersPage::class)->middleware(['auth', 'role:staff'])->name('publishers.delete');

Route::group(['middleware' => ['auth', 'role:staff']], function () {
  Route::get('/staffs', StaffsPage::class)->name('staffs.index');
  Route::get('/staffs/create', StaffCreatePage::class)->name('staffs.create');
  Route::get('/staffs/edit/{id}', StaffCreatePage::class)->name('Staffs.edit');
  Route::get('/staffs/destroy/{id}', StaffCreatePage::class)->name('staffs.delete');
});



Route::group(['middleware' => ['auth', 'role:staff']], function () {
  Route::get('/requests', RequestPage::class)->name('requests.index');
  Route::get('/requests/{id}', RequestView::class)->name('requests.view');
  Route::get('/requests/destroy/{id}', RequestPage::class)->name('requests.delete');
});


Route::group(['middleware' => ['auth', 'role:staff']], function () {
  Route::get('/borrows', BorrowsPage::class)->name('borrows.index');
  Route::get('/borrows/{id}', BorrowsView::class)->name('borrows.view');
});
