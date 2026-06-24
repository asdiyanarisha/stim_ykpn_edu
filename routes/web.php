<?php

use Illuminate\Support\Facades\Route;
use App\Models\ContentBanner;
use App\Models\News;
use App\Models\Teacher;
use App\Models\CategoryTeacher;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\SitemapController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicPagesController::class, 'index']);

// XML Sitemap (SEO) — <loc> otomatis pakai APP_URL dari .env
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// robots.txt dinamis — URL sitemap otomatis dari APP_URL di .env
Route::get('/robots.txt', function () {
    $content = view('robots')->render();
    return response($content, 200)->header('Content-Type', 'text/plain');
});


Route::get('/berita/{id}', [PublicPagesController::class, 'newsDetail']);

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/unauthenticated', function () {
    return view('unauthenticated');
});
Route::get('/masterData/teacher', function () {
    return view('teacher');
});
Route::get('/masterData/teacher/create', function () {
    return view('teacher-form');
});
Route::get('/masterData/teacher/show/{id}', function ($id) {
    return view('teacher-show');
});
Route::get('/masterData/teacher/edit/{id}', function ($id) {
    return view('teacher-edit');
});

// Affiliate Management
Route::get('/affiliate', function () {
    return view('affiliate');
});
Route::get('/affiliate/create', function () {
    return view('affiliate-form');
});
Route::get('/affiliate/show/{id}', function ($id) {
    return view('affiliate-show');
});
Route::get('/affiliate/edit/{id}', function ($id) {
    return view('affiliate-edit');
});
Route::get('/afiliate', function () {
    return redirect('/affiliate');
});

// Kategori Dosen
Route::get('/masterData/teacher/category', fn() => view('category-teacher'))->name('category-teacher.index');
Route::get('/masterData/teacher/category/show/{id}', fn() => view('category-teacher-show'))->name('category-teacher.show');

// Jabatan
Route::get('/masterData/job-title', fn() => view('job-title'))->name('job-title.index');
Route::get('/masterData/job-title/show/{id}', fn() => view('job-title-show'))->name('job-title.show');

Route::get('/content/banner', function () {
    return view('banner');
});

Route::get('/content/berita', function () {
    return view('news');
});

Route::get('/content/berita/create', function () {
    return view('news-form');
});

Route::get('/content/berita/show/{id}', function ($id) {
    return view('news-show');
});

Route::get('/content/berita/edit/{id}', function ($id) {
    return view('news-edit');
});

// Announcement Admin Dashboard
Route::get('/announcement', function () {
    return view('announcement');
});

Route::get('/announcement/create', function () {
    return view('announcement-form');
});

Route::get('/announcement/show/{id}', function ($id) {
    return view('announcement-show');
});

Route::get('/announcement/edit/{id}', function ($id) {
    return view('announcement-edit');
});

Route::get('/content/lowongan-kerja', function () {
    return view('job-vacancies');
});

Route::get('/content/lowongan-kerja/create', function () {
    return view('job-vacancies-form');
});

Route::get('/content/lowongan-kerja/edit/{id}', function ($id) {
    return view('job-vacancies-edit');
});

Route::get('/content/logo-sertifikasi', function () {
    return view('certification-logos');
});

Route::get('/content/logo-sertifikasi/create', function () {
    return view('certification-logos-form');
});

Route::get('/content/logo-sertifikasi/edit/{id}', function ($id) {
    return view('certification-logos-edit');
});

Route::get('/content/profil/greeting', function () {
    return view('greeting-chief-form');
});

Route::get('/content/profil/core-values', function () {
    return view('core-values-form');
});

Route::get('/content/profil/history', function () {
    return view('history-form');
});

Route::get('/content/profil/logo-symbol', function () {
    return view('logo-symbol-form');
});

Route::get('/content/profil/facility', function () {
    return view('facilities');
});

Route::get('/content/profil/facility/create', function () {
    return view('facility-form');
});

Route::get('/content/profil/facility/edit/{id}', function ($id) {
    return view('facility-edit');
});

Route::get('/content/profil/facility/show/{id}', function ($id) {
    return view('facility-show');
});

Route::get('/content/profil/spmi-akreditasi', function () {
    return view('spmi-akreditasi-form');
});

Route::get('/academic/programs/goals', function () {
    return view('academic-goal-form');
});

Route::get('/academic/programs/how-to-achieve', function () {
    return view('academic-goal-achieve-form');
});

Route::get('/academic/programs/study-load', function () {
    return view('study-load-form');
});

Route::get('/academic/programs/sks', function () {
    return view('sks-form');
});

Route::get('/academic/programs/level-period-study', function () {
    return view('level-period-study-form');
});

Route::get('/academic/programs/academic-activities', function () {
    return view('academic-activities-form');
});

Route::get('/academic/programs/academic-advisor', function () {
    return view('academic-advisor-form');
});

Route::get('/academic/programs/academic-sanction', function () {
    return view('academic-sanction-form');
});

Route::get('/content/academic-calendar', function () {
    return view('academic-calendar-form');
});

Route::get('/content/academic-calendar-category', function () {
    return view('academic-calendar-category-index');
});

Route::get('/academic/provision/attendance', function () {
    return view('attendance-lecture-form');
});

Route::get('/academic/provision/code-conduct', function () {
    return view('code-conduct-form');
});

Route::get('/academic/provision/class-capacity', function () {
    return view('class-capacity-form');
});

Route::get('/academic/provision/attendance-count', function () {
    return view('attendance-count-form');
});

Route::get('/academic/provision/evaluation-system', function () {
    return view('evaluation-system-form');
});

Route::get('/academic/provision/seminar-proposal', function () {
    return view('seminar-proposal-form');
});

Route::get('/academic/graduation-exam-condition/exam', function () {
    return view('exam-form');
});

Route::get('/academic/graduation-exam-condition/exam-rules', function () {
    return view('exam-rules-form');
});

Route::get('/academic/graduation-exam-condition/graduation', function () {
    return view('graduation-form');
});

Route::get('/academic/graduation-exam-condition/yudisium', function () {
    return view('yudisium-form');
});

Route::get('/academic/graduation-exam-condition/graduation-announcement', function () {
    return view('graduation-announcement-form');
});

Route::get('/academic/library', function () {
    return view('academic-library-form');
});

Route::get('/content/profil/achievement', function () {
    return view('achievements');
});

Route::get('/content/profil/achievement/create', function () {
    return view('achievement-form');
});

Route::get('/content/profil/achievement/edit/{id}', function ($id) {
    return view('achievement-edit');
});

Route::get('/content/profil/achievement/show/{id}', function ($id) {
    return view('achievement-show');
});

Route::get('/content/banner/show/{id}', function ($id) {
    return view('banner-show');
});

Route::get('/content/banner/create', function () {
    return view('banner-form');
});
Route::get('/content/banner/edit/{id}', function ($id) {
    return view('banner-edit');
});

// Jurnal Penelitian
Route::get('/research/journal', fn() => view('journal'))->name('journal');
Route::get('/research/journal/create', fn() => view('journal-form'))->name('journal.create');
Route::get('/research/journal/show/{id}', fn() => view('journal-show'))->name('journal.show');
Route::get('/research/journal/edit/{id}', fn() => view('journal-edit'))->name('journal.edit');

// Kegiatan Mahasiswa
Route::get('/student/activity', fn() => view('student-activity'))->name('student.activity');
Route::get('/student/activity/create', fn() => view('student-activity-form'))->name('student.activity.create');
Route::get('/student/activity/show/{id}', fn() => view('student-activity-show'))->name('student.activity.show');
Route::get('/student/activity/edit/{id}', fn() => view('student-activity-edit'))->name('student.activity.edit');

// Student UKM
Route::get('/student/ukm', fn() => view('student-ukm'))->name('student.ukm');
Route::get('/student/ukm/create', fn() => view('student-ukm-form'))->name('student.ukm.create');
Route::get('/student/ukm/show/{id}', fn() => view('student-ukm-show'))->name('student.ukm.show');
Route::get('/student/ukm/edit/{id}', fn() => view('student-ukm-edit'))->name('student.ukm.edit');

// Testimony Alumni
Route::get('/student/testimony', fn() => view('student-testimony'))->name('student.testimony');
Route::get('/student/testimony/create', fn() => view('student-testimony-form'))->name('student.testimony.create');
Route::get('/student/testimony/show/{id}', fn() => view('student-testimony-show'))->name('student.testimony.show');
Route::get('/student/testimony/edit/{id}', fn() => view('student-testimony-edit'))->name('student.testimony.edit');

// Campus Live Video
Route::get('/campus-life/video', fn() => view('campus-live-video'))->name('campus.live.video');
Route::get('/campus-life/video/create', fn() => view('campus-live-video-form'))->name('campus.live.video.create');
Route::get('/campus-life/video/show/{id}', fn() => view('campus-live-video-show'))->name('campus.live.video.show');
Route::get('/campus-life/video/edit/{id}', fn() => view('campus-live-video-edit'))->name('campus.live.video.edit');

// Lodging Information
Route::get('/campus-life/lodging-information', fn() => view('lodging-information-form'))->name('campus.live.lodging.information');

// PMB
Route::get('/pmb/scholarship', fn() => view('pmb-scholarship-form'))->name('pmb.scholarship');
Route::get('/pmb/program-excellence', fn() => view('pmb-program-excellence-form'))->name('pmb.program.excellence');
Route::get('/pmb/program-reguler', fn() => view('pmb-program-reguler-form'))->name('pmb.program.reguler');
Route::get('/pmb/program-extensi', fn() => view('pmb-program-extensi-form'))->name('pmb.program.extensi');

// Roles Management
Route::get('/roles', fn() => view('role'))->name('role.index');
Route::get('/roles/create', fn() => view('role-form'))->name('role.create');
Route::get('/roles/edit/{id}', fn() => view('role-edit'))->name('role.edit');

// User Management
Route::get('/user', fn() => view('user'))->name('user.index');
Route::get('/user/create', fn() => view('user-form'))->name('user.create');
Route::get('/user/show/{id}', fn() => view('user-show'))->name('user.show');
Route::get('/user/edit/{id}', fn() => view('user-edit'))->name('user.edit');

// Brochure Management
Route::get('/brochure', fn() => view('brochure'))->name('brochure.index');
Route::get('/brochure/create', fn() => view('brochure-form'))->name('brochure.create');
Route::get('/brochure/show/{id}', fn() => view('brochure-show'))->name('brochure.show');
Route::get('/brochure/edit/{id}', fn() => view('brochure-edit'))->name('brochure.edit');

// Public File Management
Route::get('/public-files', fn() => view('public-files'))->name('public-files.index');
Route::get('/public-files/create', fn() => view('public-files-form'))->name('public-files.create');
Route::get('/public-files/show/{id}', fn() => view('public-files-show'))->name('public-files.show');
Route::get('/public-files/edit/{id}', fn() => view('public-files-edit'))->name('public-files.edit');

// Voucher Management
Route::get('/voucher', fn() => view('voucher'))->name('voucher.index');
Route::get('/voucher/create', fn() => view('voucher-form'))->name('voucher.create');
Route::get('/voucher/show/{id}', fn() => view('voucher-show'))->name('voucher.show');
Route::get('/voucher/edit/{id}', fn() => view('voucher-edit'))->name('voucher.edit');

// Academic School Year Management
Route::get('/academic/school-year', fn() => view('academic-school-year'))->name('academic-school-year.index');
Route::get('/academic/school-year/create', fn() => view('academic-school-year-form'))->name('academic-school-year.create');
Route::get('/academic/school-year/show/{id}', fn() => view('academic-school-year-show'))->name('academic-school-year.show');
Route::get('/academic/school-year/edit/{id}', fn() => view('academic-school-year-edit'))->name('academic-school-year.edit');

// Program Study Management
Route::get('/academic/programs', fn() => view('program-study'))->name('program-study.index');
Route::get('/academic/programs/create', fn() => view('program-study-form'))->name('program-study.create');
Route::get('/academic/programs/show/{id}', fn() => view('program-study-show'))->name('program-study.show');
Route::get('/academic/programs/edit/{id}', fn() => view('program-study-edit'))->name('program-study.edit');

// Payment Settings
Route::get('/payment_settings', fn() => view('payment-setting-form'))->name('payment-settings');

// User Setting
Route::get('/setting', fn() => view('user-setting'))->name('user-setting');

// New Academic Landing Pages (Modular Blade)
Route::get('/sambutan-ketua', [PublicPagesController::class, 'greeting']);
Route::get('/sambutan-ketua', [PublicPagesController::class, 'greeting']);

Route::get('/visi-misi', fn() => view('visi-misi'));
Route::get('/visi-misi', fn() => view('visi-misi'));

Route::get('/profil', fn() => view('profil'));
Route::get('/profil', fn() => view('profil'));

Route::get('/logo', fn() => view('logo'));
Route::get('/logo', fn() => view('logo'));

Route::get('/dosen', [PublicPagesController::class, 'teacherList']);

Route::get('/dosen/{id}', [PublicPagesController::class, 'teacherDetail']);

Route::get('/dosen/{id}', [PublicPagesController::class, 'teacherDetail']);

Route::get('/dosen', [PublicPagesController::class, 'teacherList']);

Route::get('/pimpinan', [PublicPagesController::class, 'pimpinan']);
Route::get('/pimpinan', [PublicPagesController::class, 'pimpinan']);

Route::get('/fasilitas', [PublicPagesController::class, 'facilities']);

Route::get('/prestasi', fn() => view('prestasi'));
Route::get('/prestasi', fn() => view('prestasi'));

Route::get('/spmi', fn() => view('spmi'));
Route::get('/spmi', fn() => view('spmi'));

// Academic Program Study Sub-Pages (Modular Blade)
Route::get('/program/{slug}', [PublicPagesController::class, 'programDetail']);
Route::get('/program/{slug}', [PublicPagesController::class, 'programDetail']);

Route::get('/sasaran-pendidikan', fn() => view('sasaran-pendidikan'));
Route::get('/sasaran-pendidikan', fn() => view('sasaran-pendidikan'));

Route::get('/cara-mencapai-sasaran', fn() => view('cara-mencapai-sasaran'));
Route::get('/cara-mencapai-sasaran', fn() => view('cara-mencapai-sasaran'));

Route::get('/beban-studi', fn() => view('beban-studi'));
Route::get('/beban-studi', fn() => view('beban-studi'));

Route::get('/sks', fn() => view('sks'));
Route::get('/sks', fn() => view('sks'));

Route::get('/jenjang-studi', fn() => view('jenjang-studi'));
Route::get('/jenjang-studi', fn() => view('jenjang-studi'));

Route::get('/kegiatan-akademik', fn() => view('kegiatan-akademik'));
Route::get('/kegiatan-akademik', fn() => view('kegiatan-akademik'));

Route::get('/dosen-pembimbing', fn() => view('dosen-pembimbing'));
Route::get('/dosen-pembimbing', fn() => view('dosen-pembimbing'));

Route::get('/sanksi-akademik', fn() => view('sanksi-akademik'));
Route::get('/sanksi-akademik', fn() => view('sanksi-akademik'));

// Newly Migrated Academic & Provision Pages
Route::get('/kalender-akademik', [PublicPagesController::class, 'academicCalendar']);
Route::get('/kalender-akademik', [PublicPagesController::class, 'academicCalendar']);

Route::get('/kehadiran-kuliah', fn() => view('kehadiran-kuliah'));
Route::get('/kehadiran-kuliah', fn() => view('kehadiran-kuliah'));

Route::get('/tata-tertib-kuliah', fn() => view('tata-tertib-kuliah'));
Route::get('/tata-tertib-kuliah', fn() => view('tata-tertib-kuliah'));

Route::get('/jumlah-kehadiran', fn() => view('jumlah-kehadiran'));
Route::get('/jumlah-kehadiran', fn() => view('jumlah-kehadiran'));

Route::get('/seminar-proposal', fn() => view('seminar-proposal'));
Route::get('/seminar-proposal', fn() => view('seminar-proposal'));

Route::get('/ketentuan-ujian', fn() => view('ketentuan-ujian'));
Route::get('/ketentuan-ujian', fn() => view('ketentuan-ujian'));

Route::get('/tata-tertib-ujian', fn() => view('tata-tertib-ujian'));
Route::get('/tata-tertib-ujian', fn() => view('tata-tertib-ujian'));

Route::get('/kelulusan', fn() => view('kelulusan'));
Route::get('/kelulusan', fn() => view('kelulusan'));

Route::get('/yudisium', fn() => view('yudisium'));
Route::get('/yudisium', fn() => view('yudisium'));

Route::get('/perpustakaan', fn() => view('perpustakaan'));
Route::get('/perpustakaan', fn() => view('perpustakaan'));

// PMB Admin Dashboard
Route::get('/pmb', fn() => view('pmb-admin'))->name('pmb.admin.index');
Route::get('/pmb/show/{id}', fn() => view('pmb-admin-show'))->name('pmb.admin.show');
Route::get('/pmb/edit/{id}', fn() => view('pmb-admin-edit'))->name('pmb.admin.edit');

// Newly Migrated PMB Landing Pages
Route::get('/pmb.html', function () {
    return redirect(rtrim(config('app.pmb_site_url', 'http://localhost:8001'), '/') . '/', 301);
});
Route::get('/pendaftaran-pmb', function () {
    return redirect(rtrim(config('app.pmb_site_url', 'http://localhost:8001'), '/') . '/', 301);
});

Route::get('/biaya-kuliah', function () {
    return redirect(rtrim(config('app.pmb_site_url', 'http://localhost:8001'), '/') . '/biaya-kuliah', 301);
});

Route::get('/beasiswa', function () {
    return redirect(rtrim(config('app.pmb_site_url', 'http://localhost:8001'), '/') . '/beasiswa', 301);
});

Route::get('/program-reguler', function () {
    return redirect(rtrim(config('app.pmb_site_url', 'http://localhost:8001'), '/') . '/program-reguler', 301);
});

Route::get('/program-ekstensi', function () {
    return redirect(rtrim(config('app.pmb_site_url', 'http://localhost:8001'), '/') . '/program-ekstensi', 301);
});

Route::get('/pengumuman-diterima', function () {
    return redirect(rtrim(config('app.pmb_site_url', 'http://localhost:8001'), '/') . '/pengumuman-diterima', 301);
});

// Batch 3 - Student, Campus Life, and Information Pages
Route::get('/kegiatan-mahasiswa', [PublicPagesController::class, 'studentActivities']);
Route::get('/kegiatan-mahasiswa', [PublicPagesController::class, 'studentActivities']);

Route::get('/ukm', [PublicPagesController::class, 'ukm']);
Route::get('/ukm', [PublicPagesController::class, 'ukm']);

Route::get('/ppkpt', fn() => view('ppkpt'));
Route::get('/ppkpt', fn() => view('ppkpt'));

Route::get('/pengumuman', [PublicPagesController::class, 'pengumumanList']);
Route::get('/pengumuman/{id}', [PublicPagesController::class, 'pengumumanDetail']);

Route::get('/video', [PublicPagesController::class, 'video']);

Route::get('/informasi-tempat-tinggal', fn() => view('informasi-tempat-tinggal'));
Route::get('/informasi-tempat-tinggal', fn() => view('informasi-tempat-tinggal'));

Route::get('/brosur', [PublicPagesController::class, 'brochure']);
Route::get('/brosur', [PublicPagesController::class, 'brochure']);

Route::get('/unduh', [PublicPagesController::class, 'unduh']);

Route::get('/alumni', [PublicPagesController::class, 'alumni']);
Route::get('/alumni', [PublicPagesController::class, 'alumni']);

Route::get('/lowongan-kerja', [PublicPagesController::class, 'jobVacancies']);
Route::get('/lowongan-kerja', [PublicPagesController::class, 'jobVacancies']);
Route::get('/lowongan-kerja/{id}', [PublicPagesController::class, 'jobVacancyDetail']);
Route::get('/lowongan-kerja/{id}', [PublicPagesController::class, 'jobVacancyDetail']);

Route::get('/whatsapp-contact', fn() => view('whatsapp-contact'))->name('whatsapp-contact.index');

Route::get('/api/inspect-data', [PublicPagesController::class, 'inspectData']);

Route::get('/berita', [PublicPagesController::class, 'newsList']);
Route::get('/berita', [PublicPagesController::class, 'newsList']);

// Jurnal Penelitian Dosen (Public Page)
Route::get('/jurnal-penelitian', [PublicPagesController::class, 'jurnalPenelitian']);

// Jurnal Pengabdian Dosen (Public Page)
Route::get('/jurnal-pengabdian', [PublicPagesController::class, 'jurnalPengabdian']);





// SEO 301 Redirect for legacy .html URLs
Route::get('{any}.html', function ($any) {
    return redirect($any, 301);
})->where('any', '.*');
