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
        Schema::create('spmi_akreditasi', function (Blueprint $table) {
            $table->id();
            $table->text('dasar_hukum')->nullable();
            $table->text('dokumen_spmi')->nullable();
            $table->text('dokumen_akreditasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmi_akreditasi');
    }
};
