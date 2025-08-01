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
        Schema::table('merchandises', function (Blueprint $table) {
            // Change category to string to avoid enum constraints
            $table->string('category', 100)->change();
            // Change status to string to avoid enum constraints
            $table->string('status', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('merchandises', function (Blueprint $table) {
            // Revert back to original enums
            $table->enum('category', ['kaos', 'jaket', 'stiker', 'topi', 'tas', 'aksesoris'])->change();
            $table->enum('status', ['available', 'out_of_stock', 'discontinued'])->change();
        });
    }
};
