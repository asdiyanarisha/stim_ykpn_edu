<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('content_banner', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('created_by');
        });

        // Auto-populate sort_order berdasarkan id yang sudah ada
        // Banner dengan id lebih kecil mendapat sort_order lebih kecil (urutan lama terjaga)
        DB::statement('UPDATE content_banner SET sort_order = id WHERE deleted_at IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('content_banner', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
