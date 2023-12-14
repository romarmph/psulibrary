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
    Schema::create('books', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('isbn')->unique();
      $table->string('title', 150);
      $table->string('description', 255);
      $table->foreignId('category_id')->constrained('categories');
      $table->foreignId('publisher_id')->constrained('publishers');
      $table->tinyInteger('total_copies')->default(0);
      $table->tinyInteger('available_copies')->default(0);
      $table->string('photo_url', 255)->default('');
      $table->foreignId('created_by')->constrained('staffs');
      $table->foreignId('updated_by')->constrained('staffs');
      $table->foreignId('deleted_by')->nullable()->constrained('staffs');
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('books');
  }
};
