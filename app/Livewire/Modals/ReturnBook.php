<?php

namespace App\Livewire\Modals;

use App\Models\Book;
use App\Models\BorrowedBooks;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class ReturnBook extends ModalComponent
{
  public $book_id;
  public $borrow_id;

  public function render()
  {
    return view('livewire.modals.return-book', [
      'book_id' => $this->book_id,
      'borrow_id' => $this->borrow_id,
    ]);
  }


  public function returnBook()
  {
    $book = BorrowedBooks::query()
      ->where('book_id', $this->book_id)
      ->where('borrow_detail_id', $this->borrow_id)
      ->first();

    $book->update([
      'received_by' => auth()->user()->id,
      'returned_at' => now(),
    ]);

    $this->updateBook($this->book_id, $book->quantity);

    $book->save();

    $this->closeModal();

    session()->flash('success', 'Book returned successfully!');

    return redirect()->route('borrows.view', ['id' => $this->borrow_id]);
  }

  private function updateBook($book_id, $quantity)
  {
    $book = Book::find($book_id);

    $book->update([
      'available_copies' => $book->available_copies + $quantity,
    ]);

    $book->save();
  }
}
