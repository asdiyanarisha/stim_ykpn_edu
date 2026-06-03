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
        \Illuminate\Support\Facades\DB::table('pmb')
            ->whereIn('program_studi', ['S1 Ekstensi', 'S1 Manajemen - Ekstensi'])
            ->update(['program_studi' => 'S1 Manajemen Ekstensi']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::table('pmb')
            ->where('program_studi', 'S1 Manajemen Ekstensi')
            ->update(['program_studi' => 'S1 Manajemen - Ekstensi']);
    }
};
