<?php

namespace App\Livewire\Admin\Publishers;

use Livewire\Component;

class PublishersPage extends Component
{

    public $name;

    public $oldAuthorId;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.admin.publishers.publishers-page', [
            'mode' => $this->isEdit ? 'Edit' : 'Create'
        ]);
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
}
