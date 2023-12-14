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
    Schema::create('faculties', function (Blueprint $table) {
      $table->id();
      $table->string('employee_number', 10)->unique();
      $table->string('first_name', 100);
      $table->string('last_name', 100);
      $table->string('photo_url', 255)->default('');
      $table->string('password', 60);
      $table->foreignId('department_id')->constrained('departments');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('faculties');
  }
};
