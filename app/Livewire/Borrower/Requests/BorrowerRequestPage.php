<?php

namespace App\Livewire\Borrower\Requests;

use Livewire\Component;

class BorrowerRequestPage extends Component
{
  public function render()
  {
    $user = auth()->user();
    return view('livewire.borrower.requests.borrower-request-page', [
      'user' => $user,
    ],)->layout('layouts.borrower');
  }
}
