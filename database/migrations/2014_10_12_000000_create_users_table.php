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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('first_name', 100);
      $table->string('last_name', 100);
      $table->string('id_number', 10)->unique();
      $table->string('email')->unique();
      $table->string('phone_number', 20)->unique();
      $table->string('address', 100);
      $table->string('photo_url', 200)->default('');
      $table->string('password');
      $table->enum('type', ['staff', 'student', 'faculty'])->default('staff');
      $table->foreignId('created_by')->constrained('users');
      $table->foreignId('updated_by')->constrained('users');
      $table->foreignId('deleted_by')->nullable()->constrained('users');
      $table->timestamp('deleted_at')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
