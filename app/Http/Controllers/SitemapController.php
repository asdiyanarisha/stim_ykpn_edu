<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Teacher;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for all public pages.
     */
    public function index(): Response
    {
        // Static public pages with their priorities and change frequencies
        $staticPages = [
            // Core pages
            ['url' => '/',               'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => '/berita',         'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => '/pengumuman',     'priority' => '0.8', 'changefreq' => 'daily'],

            // PMB & Programs
            ['url' => '/pmb.html',              'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/biaya-kuliah',           'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/beasiswa',               'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/program-reguler',        'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/program-ekstensi',       'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/pengumuman-diterima',    'priority' => '0.7', 'changefreq' => 'weekly'],

            // Profil & Institusi
            ['url' => '/profil',            'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/visi-misi',         'priority' => '0.7', 'changefreq' => 'yearly'],
            ['url' => '/sambutan-ketua',    'priority' => '0.6', 'changefreq' => 'yearly'],
            ['url' => '/pimpinan',          'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/fasilitas',         'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/logo',              'priority' => '0.4', 'changefreq' => 'yearly'],
            ['url' => '/prestasi',          'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => '/spmi',              'priority' => '0.6', 'changefreq' => 'yearly'],

            // Dosen
            ['url' => '/dosen',             'priority' => '0.8', 'changefreq' => 'monthly'],

            // Kemahasiswaan
            ['url' => '/kegiatan-mahasiswa', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => '/ukm',               'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/ppkpt',             'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/alumni',            'priority' => '0.7', 'changefreq' => 'monthly'],

            // Akademik - Program Studi
            ['url' => '/sasaran-pendidikan',    'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/cara-mencapai-sasaran', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/beban-studi',           'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/sks',                   'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/jenjang-studi',         'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/kegiatan-akademik',     'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/dosen-pembimbing',      'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/sanksi-akademik',       'priority' => '0.5', 'changefreq' => 'yearly'],

            // Akademik - Ketentuan
            ['url' => '/kalender-akademik',     'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/kehadiran-kuliah',       'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/tata-tertib-kuliah',    'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/jumlah-kehadiran',      'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/seminar-proposal',      'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/ketentuan-ujian',       'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/tata-tertib-ujian',     'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/kelulusan',             'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/yudisium',              'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/perpustakaan',          'priority' => '0.6', 'changefreq' => 'monthly'],

            // Penelitian & Pengabdian
            ['url' => '/jurnal-penelitian',     'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/jurnal-pengabdian',     'priority' => '0.6', 'changefreq' => 'monthly'],

            // Informasi Umum
            ['url' => '/lowongan-kerja',            'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => '/video',                     'priority' => '0.5', 'changefreq' => 'monthly'],
            ['url' => '/informasi-tempat-tinggal',  'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => '/brosur',                    'priority' => '0.5', 'changefreq' => 'monthly'],
            ['url' => '/unduh',                     'priority' => '0.5', 'changefreq' => 'monthly'],
        ];

        // Dynamic: all published news articles
        $newsItems = News::select('id', 'updated_at', 'created_at')
            ->latest()
            ->get();

        // Dynamic: all teachers/lecturers
        $teachers = Teacher::select('id', 'updated_at')
            ->get();

        $content = view('sitemap', compact('staticPages', 'newsItems', 'teachers'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
