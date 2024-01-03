<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreatePublisherForm extends ModalComponent
{
  public $name;

  public function render()
  {
    return view('livewire.modals.create-publisher-form');
  }

  public function createPublisher()
  {
    $this->validate([
      'name' => 'required|unique:publishers',
    ]);

    \App\Models\Publisher::create([
      'name' => $this->name,
      'created_by' => auth()->user()->id,
      'updated_by' => auth()->user()->id,
    ]);


    $this->closeModalWithEvents(['publisherCreated']);
  }
}
