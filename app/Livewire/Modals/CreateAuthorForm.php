<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateAuthorForm extends ModalComponent
{
  public $name;

  public function render()
  {
    return view('livewire.modals.create-author-form');
  }

  public function createAuthor()
  {
    $this->validate([
      'name' => 'required|unique:authors',
    ]);

    \App\Models\Author::create([
      'name' => $this->name,
      'created_by' => auth()->user()->id,
      'updated_by' => auth()->user()->id,
    ]);


    $this->closeModalWithEvents(['authorCreated']);
  }
}
