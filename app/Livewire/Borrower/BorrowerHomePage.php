<?php

namespace App\Livewire\Borrower;

use Livewire\Component;

class BorrowerHomePage extends Component
{
  public function render()
  {
    $user = auth()->user();

    return view(
      'livewire.borrower.borrower-home-page',
      [
        'user' => $user,
      ],
    )->layout('layouts.borrower', ['title' => 'PSU Library']);
  }
}
