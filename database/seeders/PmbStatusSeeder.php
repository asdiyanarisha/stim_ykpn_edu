<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PmbStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'id' => 1,
                'status' => 'Registrasi Awal',
                'slug' => 'registrasi-awal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'status' => 'Menunggu Pembayaran',
                'slug' => 'menunggu-pembayaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'status' => 'Pembayaran Dikonfirmasi',
                'slug' => 'pembayaran-dikonfirmasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'status' => 'Registrasi Ulang',
                'slug' => 'registrasi-ulang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'status' => 'Menunggu Konfirmasi Pendaftaran',
                'slug' => 'menunggu-konfirmasi-pendaftaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'status' => 'Diterima',
                'slug' => 'diterima',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'status' => 'Sedang Mengirim Email',
                'slug' => 'sedang-mengirim-email',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'status' => 'Gagal Mengirim Email',
                'slug' => 'gagal-mengirim-email',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($statuses as $status) {
            DB::table('pmb_status')->updateOrInsert(
                ['id' => $status['id']],
                [
                    'status' => $status['status'],
                    'slug' => $status['slug'],
                    'created_at' => $status['created_at'],
                    'updated_at' => $status['updated_at'],
                ]
            );
        }
    }
}
