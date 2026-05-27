<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semester')->insert([
            [
                'id' => 1,
                'kode' => 'ganjil',
                'nama' => 'Semester Ganjil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'kode' => 'genap',
                'nama' => 'Semester Genap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
