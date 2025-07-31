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
        Schema::create('merchandises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->enum('category', ['kaos', 'jaket', 'stiker', 'topi', 'tas', 'aksesoris']);
            $table->integer('stock')->default(0);
            $table->enum('status', ['available', 'out_of_stock', 'discontinued'])->default('available');
            $table->json('sizes')->nullable(); // For storing available sizes
            $table->json('colors')->nullable(); // For storing available colors
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandises');
    }
};
