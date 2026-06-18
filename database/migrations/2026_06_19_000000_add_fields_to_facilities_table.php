<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->string('top_facility')->nullable()->after('content');
            $table->unsignedInteger('sort_order')->default(0)->after('header_image');
        });

        // Seed 6 default facilities
        $facilities = [
            [
                'title' => 'Gedung Kampus Terpadu',
                'content' => 'Menempati lahan seluas 0.74 hektar yang asri di Jalan Palagan Tentara Pelajar km.7. Dilengkapi pusat administrasi modern, lobby yang nyaman, serta ruang terbuka hijau.',
                'top_facility' => 'Eksklusif',
                'header_image' => url('/images/fasilitas/gedung.png'),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ruang Kelas Modern',
                'content' => '16 ruang kelas berkapasitas 50 mahasiswa. Dilengkapi pendingin udara, proyektor, audio sistem, dan kursi ergonomis untuk memastikan kenyamanan belajar optimal.',
                'top_facility' => 'Full AC & Multimedia',
                'header_image' => url('/images/fasilitas/kelas.png'),
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laboratorium Komputer',
                'content' => '2 ruang lab komputer canggih dengan 50+ unit PC berkinerja tinggi, internet stabil, dan *software* khusus untuk praktik pasar modal serta kewirausahaan.',
                'top_facility' => 'High-End PC',
                'header_image' => url('/images/fasilitas/lab.png'),
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BI Corner & Perpustakaan',
                'content' => 'Ruang baca eksklusif persembahan Bank Indonesia yang menyediakan ratusan literatur finansial, moneter, perbankan, hingga jurnal-jurnal internasional berkualitas tinggi.',
                'top_facility' => 'Akses Gratis',
                'header_image' => url('/images/fasilitas/perpus.png'),
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Masjid Kampus',
                'content' => 'Fasilitas ibadah yang representatif di sisi selatan gedung. Area bersih, sejuk, dan dilengkapi sarana ibadah lengkap serta perpustakaan mini Islami.',
                'top_facility' => 'Nyaman & Sejuk',
                'header_image' => url('/images/fasilitas/masjid.png'),
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Area Diskusi Mahasiswa',
                'content' => 'Ruang-ruang diskusi semi-terbuka dengan akses *high-speed Wi-Fi* untuk memfasilitasi kerja kelompok, organisasi kemahasiswaan, dan pertukaran ide kreatif.',
                'top_facility' => '24/7 Wi-Fi',
                'header_image' => url('/images/fasilitas/diskusi.png'),
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('facilities')->insert($facilities);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Clean up seeded data
        DB::table('facilities')->whereIn('title', [
            'Gedung Kampus Terpadu',
            'Ruang Kelas Modern',
            'Laboratorium Komputer',
            'BI Corner & Perpustakaan',
            'Masjid Kampus',
            'Area Diskusi Mahasiswa'
        ])->delete();

        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['top_facility', 'sort_order']);
        });
    }
};
