<?php

namespace App\Livewire\Components;

use App\Models\Cart;
use Livewire\Component;

class BookCard extends Component
{
  public $book;

  public function render()
  {
    return view('livewire.components.book-card', [
      'book' => $this->book
    ]);
  }

  public function addToCart($id)
  {
    $cart = Cart::where('user_id', auth()->id())
      ->where('book_id', $id)
      ->first();

    if ($cart) {
      $cart->increment('quantity');
      $this->dispatch('book-added');

      return;
    }


    Cart::create([
      'user_id' => auth()->id(),
      'book_id' => $id
    ]);

    $this->dispatch('book-added');
  }
}
