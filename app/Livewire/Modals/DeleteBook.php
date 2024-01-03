<?php

namespace App\Livewire\Modals;

use App\Models\Book;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class DeleteBook extends ModalComponent
{
  public $book_id;

  public function render()
  {
    return view('livewire.modals.delete-book', [
      'book' => $this->book_id
    ]);
  }

  public function deleteBook($id)
  {
    $book = Book::find($id);
    if ($book) {
      $book->delete();
    }


    session()->flash('message', 'Book deleted successfully.');

    $this->closeModal();

    return redirect()->route('books.index');
  }
}
