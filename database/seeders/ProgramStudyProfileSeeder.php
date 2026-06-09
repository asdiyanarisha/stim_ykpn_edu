<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudy;
use App\Models\ProgramStudyConcentration;
use App\Models\ProgramStudyCareer;

class ProgramStudyProfileSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            // ─── S1 Manajemen ────────────────────────────────────────────────
            [
                'name'         => 'S1 Manajemen',
                'grade'        => 'S1',
                'slug'         => 's1-manajemen',
                'spa_fee'      => 0,
                'spa_fee_fixed'    => 0,
                'spa_fee_variable' => 0,
                'tagline'      => 'Mencetak generasi pemimpin bisnis masa depan, wirausahawan inovatif, dan manajer profesional yang tangguh di era digital.',
                'description'  => '<p>Program Studi Sarjana (S1) Manajemen di STIM YKPN Yogyakarta dirancang secara komprehensif untuk memberikan mahasiswa pemahaman mendalam tentang praktik manajemen modern, strategi bisnis inovatif, analisis keuangan, hingga pengelolaan sumber daya manusia yang adaptif.</p><p>Kurikulum kami selalu diperbarui mengikuti perkembangan tren global. Melalui kombinasi pembelajaran teori di kelas dan praktik langsung berupa study case, program magang eksklusif, serta inkubasi bisnis, mahasiswa kami tempa untuk menjadi problem solver sejati yang kritis dan kreatif.</p>',
                'study_duration' => '4 Tahun',
                'degree_title' => 'S.M.',
                'total_sks'    => 144,
                'accreditation' => 'Baik Sekali',
                'is_active'    => true,
                'order'        => 1,
                'concentrations' => [
                    ['name' => 'Manajemen Keuangan',    'description' => 'Analisis pasar modal, investasi, perbankan, dan strategi tata kelola keuangan perusahaan.', 'order' => 1],
                    ['name' => 'Manajemen Pemasaran',   'description' => 'Riset perilaku konsumen, strategi branding kreatif, dan optimasi Digital Marketing.', 'order' => 2],
                    ['name' => 'Manajemen SDM',          'description' => 'Fokus pada kepemimpinan, pengembangan organisasi, rekrutmen, dan tata kompensasi.', 'order' => 3],
                    ['name' => 'Manajemen Operasional', 'description' => 'Efisiensi lini produksi, rantai pasok (supply chain), dan sistem manajemen mutu terpadu.', 'order' => 4],
                ],
                'careers' => [
                    ['title' => 'Manajer Bisnis & Korporat',    'description' => 'Memimpin divisi di perusahaan swasta, BUMN, maupun multinasional.', 'order' => 1],
                    ['title' => 'Manajer Keuangan',              'description' => 'Perencanaan & analisis keuangan perusahaan, perbankan, asuransi.', 'order' => 2],
                    ['title' => 'Manajer Pemasaran & Brand',     'description' => 'Strategi pemasaran digital & konvensional, manajemen merek.', 'order' => 3],
                    ['title' => 'HRD & Pengembangan SDM',        'description' => 'Rekrutmen, pelatihan, pengembangan karir karyawan.', 'order' => 4],
                    ['title' => 'Konsultan Manajemen',           'description' => 'Memberikan solusi strategis bagi berbagai jenis organisasi.', 'order' => 5],
                    ['title' => 'Wirausahawan / Entrepreneur',   'description' => 'Merintis dan mengembangkan bisnis sendiri berbasis inovasi.', 'order' => 6],
                    ['title' => 'Analis Bisnis & Investasi',     'description' => 'Riset pasar, analisis investasi, valuasi aset.', 'order' => 7],
                    ['title' => 'ASN / Pegawai Pemerintahan',    'description' => 'Berkarir di instansi pemerintah pusat maupun daerah.', 'order' => 8],
                ],
            ],

            // ─── S1 Bisnis Digital ───────────────────────────────────────────
            [
                'name'         => 'S1 Bisnis Digital',
                'grade'        => 'S1',
                'slug'         => 's1-bisnis-digital',
                'spa_fee'      => 0,
                'spa_fee_fixed'    => 0,
                'spa_fee_variable' => 0,
                'tagline'      => 'Membangun pemimpin digital yang menguasai ekosistem bisnis berbasis teknologi dan inovasi era 4.0.',
                'description'  => '<p>Program Studi S1 Bisnis Digital di STIM YKPN Yogyakarta hadir untuk menjawab kebutuhan industri akan talenta yang mampu mengintegrasikan ilmu bisnis dengan teknologi digital secara mendalam.</p><p>Mahasiswa akan mempelajari e-commerce, digital marketing, data analytics, transformasi digital organisasi, hingga model bisnis startup yang relevan dengan lanskap ekonomi digital saat ini.</p>',
                'study_duration' => '4 Tahun',
                'degree_title' => 'S.M.',
                'total_sks'    => 144,
                'accreditation' => 'Baik',
                'is_active'    => true,
                'order'        => 2,
                'concentrations' => [
                    ['name' => 'E-Commerce & Marketplace',   'description' => 'Pengelolaan platform jual beli digital, logistik, dan customer journey online.', 'order' => 1],
                    ['name' => 'Digital Marketing',           'description' => 'SEO, SEM, social media marketing, content strategy, dan analitik kampanye.', 'order' => 2],
                    ['name' => 'Startup & Inovasi Digital',  'description' => 'Model bisnis startup, pitch deck, venture capital, dan product development.', 'order' => 3],
                    ['name' => 'Data & Business Intelligence', 'description' => 'Analisis data bisnis, visualisasi, dan pengambilan keputusan berbasis data.', 'order' => 4],
                ],
                'careers' => [
                    ['title' => 'Digital Marketing Specialist',  'description' => 'Mengelola strategi pemasaran digital lintas platform.', 'order' => 1],
                    ['title' => 'E-Commerce Manager',            'description' => 'Operasional dan pengembangan toko online / marketplace.', 'order' => 2],
                    ['title' => 'Business Analyst (Digital)',     'description' => 'Menganalisis data untuk mendukung keputusan bisnis.', 'order' => 3],
                    ['title' => 'Product Manager',               'description' => 'Mengelola siklus hidup produk digital dari idesi hingga launch.', 'order' => 4],
                    ['title' => 'Social Media Manager',          'description' => 'Strategi konten dan manajemen komunitas di media sosial.', 'order' => 5],
                    ['title' => 'Founder / Co-Founder Startup',  'description' => 'Merintis perusahaan rintisan berbasis teknologi.', 'order' => 6],
                ],
            ],

            // ─── D3 Manajemen ────────────────────────────────────────────────
            [
                'name'         => 'D3 Manajemen',
                'grade'        => 'D3',
                'slug'         => 'd3-manajemen',
                'spa_fee'      => 0,
                'spa_fee_fixed'    => 0,
                'spa_fee_variable' => 0,
                'tagline'      => 'Mencetak tenaga ahli manajemen terampil, siap kerja, dan kompetitif dalam 3 tahun.',
                'description'  => '<p>Program Diploma 3 (D3) Manajemen di STIM YKPN Yogyakarta dirancang untuk menghasilkan tenaga ahli madya yang profesional dan siap terjun langsung ke dunia kerja dalam waktu yang lebih singkat.</p><p>Kurikulum berbasis praktik dengan porsi besar magang industri menjadikan lulusan D3 Manajemen STIM YKPN langsung diakui dan dipercaya oleh para pelaku industri.</p>',
                'study_duration' => '3 Tahun',
                'degree_title' => 'A.Md.',
                'total_sks'    => 110,
                'accreditation' => 'Baik',
                'is_active'    => true,
                'order'        => 3,
                'concentrations' => [
                    ['name' => 'Manajemen Perkantoran',     'description' => 'Administrasi bisnis, manajemen dokumen, dan komunikasi profesional.', 'order' => 1],
                    ['name' => 'Manajemen Keuangan Dasar',  'description' => 'Akuntansi dasar, perpajakan, laporan keuangan, dan penggajian.', 'order' => 2],
                ],
                'careers' => [
                    ['title' => 'Staf Administrasi & Kesekretariatan', 'description' => 'Pengelolaan administrasi kantor perusahaan maupun instansi.', 'order' => 1],
                    ['title' => 'Staf Keuangan & Akuntansi',          'description' => 'Pembukuan, laporan keuangan, dan pengelolaan kas.', 'order' => 2],
                    ['title' => 'Staf Pemasaran',                      'description' => 'Sales, customer service, dan promosi produk/layanan.', 'order' => 3],
                    ['title' => 'Wirausaha Skala Menengah',            'description' => 'Membuka usaha sendiri dengan pengetahuan manajemen praktis.', 'order' => 4],
                    ['title' => 'Lanjut S1 (Ekstensi)',               'description' => 'Melanjutkan ke program S1 Manajemen atau Bisnis Digital.', 'order' => 5],
                ],
            ],
        ];

        foreach ($programs as $data) {
            $concentrations = $data['concentrations'];
            $careers        = $data['careers'];
            unset($data['concentrations'], $data['careers']);

            // Upsert berdasarkan slug
            $program = ProgramStudy::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            // Sync concentrations (hapus existing, insert baru)
            $program->concentrations()->delete();
            foreach ($concentrations as $c) {
                $program->concentrations()->create($c);
            }

            // Sync careers
            $program->careers()->delete();
            foreach ($careers as $c) {
                $program->careers()->create($c);
            }
        }
    }
}
