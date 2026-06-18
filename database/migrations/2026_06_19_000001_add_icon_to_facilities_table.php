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
        Schema::table('facilities', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('top_facility');
        });

        // Seed default icon classes for the existing seeded records
        DB::table('facilities')->where('title', 'Gedung Kampus Terpadu')->update(['icon' => 'fi fi-rr-building']);
        DB::table('facilities')->where('title', 'Ruang Kelas Modern')->update(['icon' => 'fi fi-rr-chalkboard-user']);
        DB::table('facilities')->where('title', 'Laboratorium Komputer')->update(['icon' => 'fi fi-rr-computer']);
        DB::table('facilities')->where('title', 'BI Corner & Perpustakaan')->update(['icon' => 'fi fi-rr-books']);
        DB::table('facilities')->where('title', 'Masjid Kampus')->update(['icon' => 'fi fi-rr-star-and-crescent']);
        DB::table('facilities')->where('title', 'Area Diskusi Mahasiswa')->update(['icon' => 'fi fi-rr-users-alt']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
