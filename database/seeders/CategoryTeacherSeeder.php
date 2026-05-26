<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryTeacher;
use Illuminate\Support\Str;

class CategoryTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Pimpinan',
            'Dosen Tetap',
            'Dosen Luar Biasa'
        ];

        foreach ($categories as $category) {
            CategoryTeacher::firstOrCreate([
                'slug' => Str::slug($category)
            ], [
                'title' => $category
            ]);
        }
    }
}
