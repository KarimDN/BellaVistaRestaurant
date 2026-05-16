<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();                          // auto increment primary key
            $table->string('name');                // e.g. "Starters", "Mains"
            $table->string('slug')->unique();      // e.g. "starters", "mains" (for URLs)
            $table->text('description')->nullable(); // optional short description
            $table->integer('order')->default(0);  // to control display order
            $table->timestamps();                  // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};