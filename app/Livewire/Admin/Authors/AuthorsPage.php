<?php

namespace App\Livewire\Admin\Authors;

use Livewire\Component;

class AuthorsPage extends Component
{
  public $name;

  public $oldAuthorId;
  public $isEdit = false;

  public function render()
  {
    return view('livewire.admin.authors.authors-page', [
      'mode' => $this->isEdit ? 'Edit' : 'Create'
    ])->layout('layouts.admin');
  }


  public function create()
  {
    $this->validate([
      'name' => 'required',
    ]);

    $name = \App\Models\Author::create([
      'name' => $this->name,
      'created_by' => auth()->user()->id,
      'updated_by' => auth()->user()->id,
    ]);

    $this->dispatch('authorAdded');

    session()->flash('success', 'Author added successfully!');

    return redirect()->route('authors.index');
  }

}
