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
        Schema::create('publications_teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->string('title', 255)->nullable();
            $table->string('journal_book_name', 255)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('volume', 50)->nullable();
            $table->string('pages', 50)->nullable();
            $table->string('year', 4)->nullable();
            $table->string('doi', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications_teachers');
    }
};
