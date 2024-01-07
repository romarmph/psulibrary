<?php

namespace App\Livewire\Admin\Borrows;

use App\Models\BorrowedBooks;
use App\Models\User;
use Livewire\Component;

class BorrowsView extends Component
{
  public $borrowId;

  public function render()
  {
    $user = User::query()
      ->join('borrow_details', 'borrow_details.borrower_id', '=', 'users.id')
      ->join('courses', 'courses.id', '=', 'users.course_id')
      ->join('departments', 'departments.id', '=', 'courses.department_id')
      ->where('borrow_details.id', $this->borrowId)
      ->select('users.*', 'courses.name as course', 'departments.name as department')
      ->first();

    return view('livewire.admin.borrows.borrows-view', [
      'user' => $user,
      'borrowId' => $this->borrowId,
    ])
      ->layout('layouts.admin');
  }

  public function mount($id)
  {
    $this->borrowId = $id;
  }
}
