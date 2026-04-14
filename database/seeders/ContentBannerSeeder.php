<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentBanner;

class ContentBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContentBanner::create([
            'title' => 'Penerimaan Mahasiswa Baru 2026',
            'description' => 'Ayo bergabung dengan STIM YKPN Yogyakarta. Pendaftaran Gelombang 1 telah dibuka untuk Program Studi Akuntansi dan Manajemen. Dapatkan kemudahan pendaftaran secara online dan berbagai pilihan potongan biaya sumbangan pengembangan.',
            'button_text' => 'Daftar Sekarang',
            'link' => 'https://pmb.stimykpn.ac.id',
            'url_image' => 'https://stimykpn.ac.id/imagecache/ori/2619fc0a573762bd6d5e594f8bee068c.webp',
            'created_by' => 1,
        ]);

        ContentBanner::create([
            'title' => 'Program Beasiswa Unggulan',
            'description' => 'Tersedia berbagai pilihan beasiswa untuk mahasiswa berprestasi dan kurang mampu. STIM YKPN berkomitmen untuk mendukung pendidikan bagi seluruh lapisan masyarakat melalui program beasiswa internal maupun eksternal.',
            'button_text' => 'Cek Beasiswa',
            'link' => '/beasiswa',
            'url_image' => 'https://picsum.photos/seed/banner2/1200/600',
            'created_by' => 1,
        ]);
    }
}
