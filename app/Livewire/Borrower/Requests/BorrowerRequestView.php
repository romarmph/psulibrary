<?php

namespace App\Livewire\Borrower\Requests;

use App\Models\BorrowRequest;
use App\Models\RequestedBook;
use App\Models\User;
use Livewire\Component;

class BorrowerRequestView extends Component
{
  public $requestId;

  public function render()
  {
    $borrowRequest = BorrowRequest::where('id', $this->requestId)->first();
    $borrower = User::query()
      ->join('courses', 'courses.id', '=', 'users.course_id')
      ->join('departments', 'departments.id', '=', 'courses.department_id')
      ->where('users.id', $borrowRequest->user_id)
      ->select([
        'users.*',
        'courses.name as course',
        'departments.name as department',
      ])->first();
    $requestedBooks = RequestedBook::query()
      ->join('books', 'books.id', '=', 'requested_books.book_id')
      ->join('borrow_requests', 'borrow_requests.id', '=', 'requested_books.borrow_request_id')
      ->join('publishers', 'publishers.id', '=', 'books.publisher_id')
      ->join('categories', 'categories.id', '=', 'books.category_id')
      ->where('borrow_requests.id', $this->requestId)
      ->where('borrow_requests.user_id', auth()->user()->id)
      ->select(
        'borrow_requests.id as request_id',
        'borrow_requests.user_id as borrower_id',
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


    $user = auth()->user();
    return view('livewire.borrower.requests.borrower-request-view', [
      'user' => $user,
      'borrower' => $borrower,
      'requestedBooks' => $requestedBooks,
    ],)->layout('layouts.borrower');
  }

  public function mount($id)
  {
    $this->requestId = $id;
  }
}
