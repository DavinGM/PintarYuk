<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title', 150);
            $table->string('author', 100);
            $table->decimal('price', 10, 2);
            $table->integer('discount_percentage')->default(0); // Misal: 10, 20, 50
            $table->boolean('is_on_sale')->default(false); // Status diskon aktif atau tidak
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->integer('sold_count')->default(0);
            $table->string('cover')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};