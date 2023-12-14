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
    Schema::create('borrow_details', function (Blueprint $table) {
      $table->id();
      $table->dateTime('borrowed_from_date')->default(now());
      $table->dateTime('borrowed_to_date')->default(now()->addDays(3));
      $table->foreignId('issued_by')->constrained('staffs');
      $table->dateTime('issued_at')->default(now());
      $table->unsignedBigInteger('borrower_id');
      $table->string('borrower_type');
      $table->index(['borrower_id', 'borrower_type']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('borrow_details');
  }
};
