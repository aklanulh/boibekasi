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
        Schema::create('documentations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['touring', 'event', 'sunmori', 'baksos', 'workshop']);
            $table->date('date');
            $table->string('image');
            $table->string('video_url')->nullable();
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('views')->default(0);
            $table->enum('status', ['published', 'draft', 'archived'])->default('published');
            $table->string('photographer')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};
