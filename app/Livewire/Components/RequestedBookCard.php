<?php

namespace App\Livewire\Components;


use Livewire\Component;

class RequestedBookCard extends Component
{
  public $book;

  public function render()
  {
    return view('livewire.components.requested-book-card', [
      'book' => $this->book,
    ]);
  }
}
