<?php

namespace App\Livewire\Borrower\Books;

use Livewire\Component;

class RequestPage extends Component
{
    public function render()
    {
        $user = auth()->user();
        return view('livewire.borrower.books.request-page',
        [
            'user' => $user,
            ],)->layout('layouts.borrower');
    }
}
