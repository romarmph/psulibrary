<?php

namespace App\Livewire\Admin\Authors;

use Livewire\Component;

class AuthorsPage extends Component
{
  public $name;

  public $oldAuthorId;
  public $isEdit;

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

  public function mount($id = null)
    {
        $author = \App\Models\Author::find($id);

        if ($author) {
            $this->oldAuthorId = $id;
            $this->name = $author->name;
            $this->isEdit = true;
        }
    }

    public function edit()
    {
      
      $author = \App\Models\Author::find($this->oldAuthorId);

  
      $this->validate([
        'name' => 'required',
      ]);
  
  
      $author->name = $this->name;
      $author->updated_by = auth()->user()->id;
  
  
      $author->save();
  
  
      $this->dispatch('authorUpdated');
  
      session()->flash('success', 'Author updated successfully!');
  
      return redirect()->route('authors.index');
    }
    

}
