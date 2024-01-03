<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class BooksPage extends Component
{
  public function render()
  {
    return view('livewire.admin.books-page')->layout('layouts.admin');
  }
}
