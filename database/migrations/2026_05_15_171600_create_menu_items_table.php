<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // links to categories
            $table->string('name');                      // e.g. "Grilled Salmon"
            $table->text('description')->nullable();     // dish description
            $table->decimal('price', 8, 2);             // e.g. 12.99
            $table->string('image')->nullable();         // image filename
            $table->boolean('is_available')->default(true); // show/hide dish
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};