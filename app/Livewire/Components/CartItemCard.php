<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CartItemCard extends Component
{
  public $book;

  public function render()
  {
    return view('livewire.components.cart-item-card', [
      'book' => $this->book,
    ]);
  }
}
