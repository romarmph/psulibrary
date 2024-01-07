<?php

namespace App\Livewire\Admin\Borrows;

use Livewire\Component;

class BorrowsPage extends Component
{
  public function render()
  {
    return view('livewire.admin.borrows.borrows-page')
      ->layout('layouts.admin');
  }
}
