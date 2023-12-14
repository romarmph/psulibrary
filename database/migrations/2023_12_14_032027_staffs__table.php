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
    Schema::create('staffs', function (Blueprint $table) {
      $table->id();
      $table->string('employee_number', 20)->unique();
      $table->string('first_name', 50);
      $table->string('last_name', 50);
      $table->string('photo_url', 255)->default('');
      $table->string('password', 60);
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
    Schema::dropIfExists('staffs');
  }
};
