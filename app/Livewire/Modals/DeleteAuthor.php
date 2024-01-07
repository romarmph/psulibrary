<?php

namespace App\Livewire\Modals;

use App\Models\Author;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class DeleteAuthor extends ModalComponent
{
    public $author_id;

    public function render()
    {
        return view('livewire.modals.delete-author',[
            'author' => $this->author_id,
        ]);
    }

    public function deleteAuthor($id)
    {
        $author = Author::find($id);
        if ($author) {
        $author->delete();
    }


    session()->flash('message', 'Author deleted successfully.');

    $this->closeModal();

    return redirect()->route('authors.index');
  }
}
