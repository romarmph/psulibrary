<?php

namespace App\Livewire\Borrower;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class CartPage extends Component
{
  public $booksInCart = [];

  public function render()
  {
    $user = auth()->user();

    $totalBookQuantity = 0;

    foreach ($this->booksInCart as $book) {
      $totalBookQuantity += $book->quantity;
    }

    return view(
      'livewire.borrower.cart-page',
      [
        'user' => $user,
        'books' => $this->booksInCart,
        'cartCount' => count($this->booksInCart),
        'total' => $totalBookQuantity,
      ],
    )->layout('layouts.borrower', ['title' => 'PSU Library']);
  }

  #[On('cartUpdated')]
  public function updateCart()
  {
    $this->booksInCart = DB::table('carts')
      ->join('books', 'carts.book_id', '=', 'books.id')
      ->join('categories', 'books.category_id', '=', 'categories.id')
      ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
      ->select('books.*', 'carts.quantity', 'categories.name as category', 'publishers.name as publisher')
      ->where('carts.user_id', '=', auth()->user()->id)
      ->get();
  }


  public function mount()
  {
    $this->booksInCart = DB::table('carts')
      ->join('books', 'carts.book_id', '=', 'books.id')
      ->join('categories', 'books.category_id', '=', 'categories.id')
      ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
      ->select('books.*', 'carts.quantity', 'categories.name as category', 'publishers.name as publisher')
      ->where('carts.user_id', '=', auth()->user()->id)
      ->get();
  }

  public function removeFromCart($bookId)
  {
    $user = auth()->user();

    DB::table('carts')
      ->where('user_id', '=', $user->id)
      ->where('book_id', '=', $bookId)
      ->delete();

    $this->dispatch('cartUpdated');
  }

  public function increaseQuantity($bookId)
  {
    $user = auth()->user();

    DB::table('carts')
      ->where('user_id', '=', $user->id)
      ->where('book_id', '=', $bookId)
      ->increment('quantity');

    $this->dispatch('cartUpdated');
  }

  public function decreaseQuantity($bookId)
  {
    $user = auth()->user();

    DB::table('carts')
      ->where('user_id', '=', $user->id)
      ->where('book_id', '=', $bookId)
      ->decrement('quantity');

    $this->dispatch('cartUpdated');
  }

  public function request()
  {
    $user = auth()->user();




    DB::table('borrow_requests')->insert([
      'user_id' => $user->id,
      'status' => 'pending',
      'borrow_date' => now(),
      'return_date' => now()->addDays(3),
    ]);

    $requestId = DB::getPdo()->lastInsertId();

    foreach ($this->booksInCart as $book) {
      DB::table('requested_books')->insert([
        'book_id' => $book->id,
        'borrow_request_id' => $requestId,
        'quantity' => $book->quantity,
      ]);
    }

    DB::table('carts')
      ->where('user_id', '=', $user->id)
      ->delete();

    $this->dispatch('cartUpdated');
    $this->dispatch('requestSent');

    return redirect()->route('borrower.cart');
  }
}
