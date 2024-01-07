<?php

namespace App\Livewire\Borrower;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CartPage extends Component
{
  public function render()
  {
    $user = auth()->user();

    $booksInCart = DB::table('carts')
      ->join('books', 'carts.book_id', '=', 'books.id')
      ->join('categories', 'books.category_id', '=', 'categories.id')
      ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
      ->select('books.*', 'carts.quantity', 'categories.name as category', 'publishers.name as publisher')
      ->where('carts.user_id', '=', $user->id)
      ->get();


    return view(
      'livewire.borrower.cart-page',
      [
        'user' => $user,
        'books' => $booksInCart,
        'cartCount' => count($booksInCart),
      ],
    )->layout('layouts.borrower', ['title' => 'PSU Library']);
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
}
