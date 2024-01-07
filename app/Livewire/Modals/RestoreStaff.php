<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class RestoreStaff extends ModalComponent
{
  public function render()
  {
    return view('livewire.modals.restore-staff');
  }
}
