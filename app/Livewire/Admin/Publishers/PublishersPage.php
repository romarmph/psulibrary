<?php

namespace App\Livewire\Admin\Publishers;

use Livewire\Component;

class PublishersPage extends Component
{

  public $name;

  public $oldPublisherId;
  public $isEdit = false;

  public function render()
  {
    return view('livewire.admin.publishers.publishers-page', [
      'mode' => $this->isEdit ? 'Edit' : 'Create'
    ])->layout('layouts.admin');
  }

  public function create()
  {
    $this->validate([
      'name' => 'required',
    ]);

    $name = \App\Models\Publisher::create([
      'name' => $this->name,
      'created_by' => auth()->user()->id,
      'updated_by' => auth()->user()->id,
    ]);

    $this->dispatch('publisherAdded');

    session()->flash('success', 'Publisher added successfully!');

    return redirect()->route('publishers.index');
  }

  public function mount($id = null)
  {

    $publisher = \App\Models\Publisher::find($id);

    if ($publisher) {

      $this->isEdit = true;
      $this->oldPublisherId = $id;
      $this->name = $publisher->name;
    }
  }

  public function edit()
  {

    $publisher = \App\Models\Publisher::find($this->oldPublisherId);


    $this->validate([
      'name' => 'required',
    ]);


    $publisher->name = $this->name;
    $publisher->updated_by = auth()->user()->id;


    $publisher->save();


    $this->dispatch('publisherUpdated');

    session()->flash('success', 'Publisher updated successfully!');

    return redirect()->route('publishers.index');
  }
}
