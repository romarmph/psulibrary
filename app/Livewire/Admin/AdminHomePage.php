<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminHomePage extends Component
{
  public function render()
  {
    return view('livewire.admin.admin-home-page')->layout('layouts.admin');
  }
}
