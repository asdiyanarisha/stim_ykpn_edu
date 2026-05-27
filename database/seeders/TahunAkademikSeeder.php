<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahun_akademik')->insert([
            'id' => 1,
            'label' => '2025/2026',
            'tanggal_mulai' => '2025-08-01',
            'tanggal_selesai' => '2026-07-31',
            'aktif' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
