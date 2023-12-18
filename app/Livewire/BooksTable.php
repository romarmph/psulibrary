<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Book;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class BooksTable extends DataTableComponent
{
  protected $model = Book::class;

  public function configure(): void
  {
    $this->setPaginationEnabled();
    $this->setPrimaryKey('id');
  }

  public function columns(): array
  {
    return [
      Column::make("Id", "id")
        ->sortable(),
      ImageColumn::make("Image")->location(function ($row) {
        return asset('img/book-' . $row->id . '.png');
      }),
      Column::make("Title", "title")
        ->sortable(),
      Column::make("Isbn", "isbn")
        ->sortable(),
      Column::make("Description", "description")
        ->sortable(),
      Column::make("Category id", "category_id")
        ->sortable(),
      Column::make("Publisher id", "publisher_id")
        ->sortable(),
      Column::make("Published at", "published_at")
        ->sortable(),
      Column::make("Total copies", "total_copies")
        ->sortable(),
      Column::make("Available copies", "available_copies")
        ->sortable(),
      Column::make("Created by", "created_by")
        ->sortable(),
      Column::make("Updated by", "updated_by")
        ->sortable(),
      Column::make("Deleted by", "deleted_by")
        ->sortable(),
      Column::make("Created at", "created_at")
        ->sortable(),
      Column::make("Updated at", "updated_at")
        ->sortable(),
    ];
  }
}
