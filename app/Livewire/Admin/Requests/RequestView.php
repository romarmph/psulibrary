<?php

namespace App\Livewire\Admin\Requests;

use App\Models\BorrowedBooks;
use App\Models\BorrowRequest;
use App\Models\RequestedBook;
use App\Models\User;
use Livewire\Component;

class RequestView extends Component
{
  public $requestId = null;

  public function render()
  {
    $borrowRequest = BorrowRequest::where('id', $this->requestId)->first();
    $borrower = User::where('id', $borrowRequest->user_id)->first();
    $requestedBooks = RequestedBook::query()
      ->join('books', 'books.id', '=', 'requested_books.book_id')
      ->join('borrow_requests', 'borrow_requests.id', '=', 'requested_books.borrow_request_id')
      ->join('publishers', 'publishers.id', '=', 'books.publisher_id')
      ->join('categories', 'categories.id', '=', 'books.category_id')
      ->where('borrow_requests.id', $this->requestId)
      ->select(
        'requested_books.book_id',
        'requested_books.quantity',
        'books.title',
        'books.isbn',
        'books.photo_url',
        'books.published_at',
        'books.publisher_id',
        'books.category_id',
        'books.created_at',
        'books.updated_at',
        'publishers.name as publisher',
        'categories.name as category',
      )->get();


    return view(
      'livewire.admin.requests.request-view',
      [
        'borrowRequest' => $borrowRequest,
        'borrower' => $borrower,
        'requestedBooks' => $requestedBooks,
      ],
    )->layout('layouts.admin');
  }

  public function mount($id)
  {
    $this->requestId = $id;
  }
}
