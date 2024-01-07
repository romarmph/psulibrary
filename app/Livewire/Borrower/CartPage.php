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
      ->select('books.*', 'carts.quantity')
      ->where('carts.user_id', '=', $user->id)
      ->get();

    dd($booksInCart);

    return view(
      'livewire.borrower.cart-page',
      [
        'user' => $user,
        'books' => $booksInCart,
      ],
    )->layout('layouts.borrower', ['title' => 'PSU Library']);
  }
}
