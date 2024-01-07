<?php

use Illuminate\Support\Facades\Route;
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
  if (!Auth::check()) {
    return view('/login');
  }

  if (Auth::user()->deleted_at) {
    Auth::logout();
    session()->flash('account_deleted', 'Your account has been deleted.');
    return view('/login');
  }

  switch (Auth::user()->role) {
    case 'staff':
      return redirect()->route('admin.home');
    case 'borrower':
      return redirect()->route('borrower.home');
    default:
      return view('/login');
  }
})->middleware('auth');

Route::get('/dashboard', function () {
  return redirect('/');
});




require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/borrower.php';
