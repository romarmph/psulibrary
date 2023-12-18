<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\Admin\AdminHomePage;
use App\Livewire\Borrower\BorrowerHomePage;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  if (Auth::check()) {
    if (Auth::user()->role == 'staff') {
      return redirect()->route('admin.home');
    } else if (Auth::user()->role == 'borrower') {
      return redirect()->route('borrower.home');
    }
  }
  return view('/login');
})->middleware('auth');

Route::middleware(['auth', 'role:staff'])->group(function () {
  Route::get('/admin', AdminHomePage::class)->name('admin.home');
});

Route::middleware(['auth', 'role:borrower'])->group(function () {
  Route::get('/borrower', BorrowerHomePage::class)->name('borrower.home');
});


Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Group route to 404
Route::fallback(function () {
  return view('404');
});

require __DIR__ . '/auth.php';
