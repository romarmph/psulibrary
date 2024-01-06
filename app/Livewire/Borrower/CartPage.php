<?php

namespace App\Livewire\Borrower;

use Livewire\Component;

class CartPage extends Component
{
  public function render()
  {
    $user = auth()->user();

    return view(
      'livewire.borrower.cart-page',
      [
        'user' => $user,
      ],
    )->layout('layouts.borrower', ['title' => 'PSU Library']);
  }
}
