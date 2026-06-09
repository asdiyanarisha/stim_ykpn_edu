<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_study_concentrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_study_id');
            $table->string('name', 255);           // "Manajemen Keuangan"
            $table->text('description')->nullable(); // "Analisis pasar modal, investasi..."
            $table->string('icon', 100)->nullable(); // opsional, misal emoji / icon class
            $table->smallInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_study_concentrations');
    }
};
