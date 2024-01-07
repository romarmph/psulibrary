<?php

namespace App\Livewire\Modals;

use App\Models\Book;
use App\Models\RequestedBook;
use App\Models\BorrowDetail;
use App\Models\BorrowedBooks;
use App\Models\BorrowRequest;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ReleaseBooks extends ModalComponent
{
  public $request_id;

  public function render()
  {
    return view('livewire.modals.release-books', [
      'request_id' => $this->request_id,
    ]);
  }

  public function requestRelease($requestId)
  {
    $this->releaseBooks($requestId);
    $this->updateRequest($requestId);

    session()->flash('success', 'Books released successfully!');

    $this->closeModal();

    return redirect()->route('requests.index');
  }

  private function releaseBooks($requestId)
  {
    $booksToRelease = RequestedBook::query()
      ->where('borrow_request_id', $requestId)
      ->get();

    $borrower = BorrowRequest::find($requestId)->user_id;

    $borrowDetail = BorrowDetail::create([
      'issued_by' => auth()->user()->id,
      'borrower_id' => $borrower,
    ]);
    // dd($booksToRelease);

    foreach ($booksToRelease as $book) {
      BorrowedBooks::create([
        'book_id' => $book->book_id,
        'borrow_detail_id' => $borrowDetail->id,
        'quantity' => $book->quantity,
      ]);
      $this->updateBook($book->book_id, $book->quantity);
    }
  }

  private function updateRequest($requestId)
  {
    $request = BorrowRequest::find($requestId);

    $request->update([
      'status' => 'released',
    ]);

    $request->save();
  }

  private function updateBook($bookId, $quantity)
  {
    // dd($bookId, $quantity);
    $book = Book::find($bookId);

    $book->update([
      'available_copies' => $book->quantity - $quantity,
    ]);

    $book->save();
  }
}
