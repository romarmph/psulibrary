<?php

namespace App\Livewire\Components;

use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartButton extends Component
{


  public $count;

  public function render()
  {
    return view(
      'livewire.components.cart-button',
    );
  }

  public function mount()
  {
    $this->count = Cart::where('user_id', auth()->id())->count();
  }

  #[On('book-added')]
  public function refresh()
  {
    $this->count = Cart::where('user_id', auth()->id())->count();
  }
}
