<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('borrowed_books', function (Blueprint $table) {
      $table->id();
      $table->foreignId('borrow_detail_id')->constrained('borrow_details');
      $table->foreignId('book_id')->constrained('books');
      $table->tinyInteger('quantity');
      $table->dateTime('returned_at')->nullable();
      $table->foreignId('received_by')->nullable()->constrained('users');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('borrowed_books');
  }
};
