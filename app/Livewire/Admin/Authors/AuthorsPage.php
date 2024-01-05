<?php

namespace App\Livewire\Admin\Authors;

use Livewire\Component;

class AuthorsPage extends Component
{
  public function render()
  {
    return view('livewire.admin.authors.authors-page')->layout('layouts.admin');
  }
}
