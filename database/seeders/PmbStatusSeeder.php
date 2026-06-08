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
                'id' => 7,
                'status' => 'Sedang Mengirim Email',
                'slug' => 'sedang-mengirim-email',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 1,
                'status' => 'Registrasi Awal',
                'slug' => 'registrasi-awal',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'status' => 'Menunggu Pembayaran',
                'slug' => 'menunggu-pembayaran',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'status' => 'Pembayaran Dikonfirmasi',
                'slug' => 'pembayaran-dikonfirmasi',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'status' => 'Registrasi Ulang',
                'slug' => 'registrasi-ulang',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'status' => 'Menunggu Konfirmasi Pendaftaran',
                'slug' => 'menunggu-konfirmasi-pendaftaran',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'status' => 'Diterima',
                'slug' => 'diterima',
                'order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'status' => 'Gagal Mengirim Email',
                'slug' => 'gagal-mengirim-email',
                'order' => 8,
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
                    'order' => $status['order'],
                    'created_at' => $status['created_at'],
                    'updated_at' => $status['updated_at'],
                ]
            );
        }
    }
}
