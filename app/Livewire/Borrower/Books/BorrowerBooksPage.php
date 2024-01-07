<?php

namespace App\Livewire\Borrower\Books;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class BorrowerBooksPage extends Component
{
  use WithPagination;

  public $publishing_years;
  public $categories;

  public $category;
  public $search;
  public $publishedAt;
  public $limit = 10;
  public $sortField = 'title:asc';

  public function render()
  {
    $books = Book::with(['category', 'publisher', 'authors'])->search($this->search)->when($this->category, function ($query, $category) {
      return $query->where('category_id', $category);
    })->when($this->publishedAt, function ($query, $publishedAt) {
      return $query->where('published_at', $publishedAt);
    })->paginate($this->limit);



    $user = auth()->user();
    return view('livewire.borrower.books.borrower-books-page', [
      'user' => $user,
      'books' => $books,
    ],)->layout('layouts.borrower');
  }

  public function mount()
  {
    $this->publishing_years = Book::all()
      ->map(function ($book) {
        return $book->published_at;
      })
      ->unique()
      ->sortDesc();

    $this->categories = Category::all();
  }

  public function updatedPublishedAt()
  {
    $this->resetPage();
  }

  public function resetPublishedAt()
  {
    $this->reset('publishedAt');
  }
}
