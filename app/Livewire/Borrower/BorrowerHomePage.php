<?php

namespace App\Livewire\Borrower;

use Livewire\Component;

class BorrowerHomePage extends Component
{
  public function render()
  {
    return view('livewire.borrower.borrower-home-page',)->layout('layouts.borrower');
  }
}
