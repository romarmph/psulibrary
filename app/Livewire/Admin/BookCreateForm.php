<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class BookCreateForm extends Component
{
  use WithFileUploads;

  protected $listeners = ['publisherCreated' => 'refreshPublishers', 'authorCreated' => 'refreshAuthors'];

  #[Url()]
  public $selectedAuthors = [];

  public $publishers;
  public $authors;

  public $oldBookId;
  public $isEdit = false;

  public $title;
  public $isbn;
  public $image;
  public $description;
  public $category;
  public $publisher;
  public $published_at;
  public $copies;

  public function render()
  {
    $categories = \App\Models\Category::all();


    return view(
      'livewire.admin.book-create-form',
      [
        'categories' => $categories,
        'publishers' => $this->publishers,
        'authors' => $this->authors,
        'mode' => $this->isEdit ? 'Edit' : 'Create',
      ]
    )->layout('layouts.admin');
  }

  public function mount($id = null)
  {
    if ($id) {
      $this->oldBookId = $id;
      $this->isEdit = true;
      $book = \App\Models\Book::find($id);
      $this->title = $book->title;
      $this->isbn = $book->isbn;
      $this->image = $book->photo_url;
      $this->description = $book->description;
      $this->category = $book->category_id;
      $this->publisher = $book->publisher_id;
      $this->published_at = $book->published_at;
      $this->copies = $book->total_copies;
      $this->selectedAuthors = $book->authors->pluck('id')->toArray();
    }
    $this->publishers = \App\Models\Publisher::all();
    $this->authors = \App\Models\Author::all();
  }

  public function create()
  {
    $this->validate([
      'title' => 'required',
      'isbn' => 'required|unique:books',
      'image' => 'required|image|max:1024',
      'description' => 'required',
      'category' => 'required',
      'publisher' => 'required',
      'published_at' => 'required',
      'copies' => 'required',
    ]);

    $name = md5($this->image . microtime()) . '.' . $this->image->extension();
    $path = $this->image->storeAs('books', $name);
    $url = Storage::url($path);

    $book = \App\Models\Book::create([
      'title' => $this->title,
      'isbn' => $this->isbn,
      'photo_url' => $url,
      'description' => $this->description,
      'category_id' => $this->category,
      'publisher_id' => $this->publisher,
      'published_at' => $this->published_at,
      'total_copies' => $this->copies,
      'available_copies' => $this->copies,
      'created_by' => auth()->user()->id,
      'updated_by' => auth()->user()->id,
    ]);

    $book->authors()->attach($this->selectedAuthors);

    $this->dispatch('bookCreated');

    session()->flash('success', 'Book created successfully!');

    return redirect()->route('books.index');
  }

  public function edit()
  {
    // dd($this->oldBookId);
    $book = \App\Models\Book::find($this->oldBookId);

    // dd($book);

    $this->validate([
      'title' => 'required',
      'isbn' => 'required|unique:books,isbn,' . $book->id,
      'description' => 'required',
      'category' => 'required',
      'publisher' => 'required',
      'published_at' => 'required',
      'copies' => 'required',
    ]);


    $book->title = $this->title;
    $book->isbn = $this->isbn;
    $book->description = $this->description;
    $book->category_id = $this->category;
    $book->publisher_id = $this->publisher;
    $book->published_at = $this->published_at;
    $book->total_copies = $this->copies;
    $book->available_copies = $this->copies;
    $book->updated_by = auth()->user()->id;

    if (is_string($this->image)) {
      $this->image = $book->photo_url;
    } else {
      $this->validate([
        'image' => 'required|image|max:1024',
      ]);
      $name = md5($this->image . microtime()) . '.' . $this->image->extension();
      $path = $this->image->storeAs('books', $name);
      $url = Storage::url($path);
      $book->photo_url = $url;
    }

    $book->save();

    $book->authors()->sync($this->selectedAuthors);

    $this->dispatch('bookUpdated');

    session()->flash('success', 'Book updated successfully!');

    return redirect()->route('books.index');
  }


  public function refreshPublishers()
  {
    $this->publishers = \App\Models\Publisher::all();
  }

  public function refreshAuthors()
  {
    $this->authors = \App\Models\Author::all();
  }
}
