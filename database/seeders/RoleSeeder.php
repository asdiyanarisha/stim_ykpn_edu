<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'administrator'],
            ['id' => 2, 'name' => 'dosen'],
        ];

        foreach ($roles as $role) {
            \Illuminate\Support\Facades\DB::table('roles')->updateOrInsert(
                ['id' => $role['id']],
                [
                    'name' => $role['name'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
