<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'id' => 1,
                'nama' => 'ADMINISTRASI',
                'warna' => '#3B82F6',
                'ikon' => 'bi-briefcase',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'AKADEMIK',
                'warna' => '#8B5CF6',
                'ikon' => 'bi-book',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'PERKULIAHAN',
                'warna' => '#10B981',
                'ikon' => 'bi-mortarboard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama' => 'UJIAN',
                'warna' => '#F59E0B',
                'ikon' => 'bi-pencil-square',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
