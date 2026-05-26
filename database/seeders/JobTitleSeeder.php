<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobTitle;
use Illuminate\Support\Str;

class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            // Jabatan Struktural
            'Ketua',
            'Wakil Ketua I',
            'Wakil Ketua II',
            'Wakil Ketua III',
            
            // Jabatan Akademik Dosen
            'Guru Besar / Profesor',
            'Lektor Kepala',
            'Lektor',
            'Asisten Ahli',
            'Tenaga Pengajar',
            'Dosen'
        ];

        foreach ($titles as $title) {
            JobTitle::firstOrCreate([
                'slug' => Str::slug($title)
            ], [
                'title' => $title
            ]);
        }
    }
}
