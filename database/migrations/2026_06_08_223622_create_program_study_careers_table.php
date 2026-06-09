<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_study_careers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_study_id');
            $table->string('title', 255);           // "Manajer Keuangan", "Entrepreneur"
            $table->text('description')->nullable(); // keterangan singkat opsional
            $table->smallInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_study_careers');
    }
};
