<?php

namespace App\Livewire\Modals;

use App\Models\Publisher;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class DeletePublisher extends ModalComponent
{
    public $publisher_id;

    public function render()
    {
        
        return view('livewire.modals.delete-publisher', [
            'publisher' => $this->publisher_id,
        ]);
    }

    public function deletePublisher($id)
    {
        $publisher = Publisher::find($id);
        if ($publisher) {
        $publisher->delete();
    }


    session()->flash('message', 'Publisher deleted successfully.');

    $this->closeModal();

    return redirect()->route('publishers.index');
  }
}
