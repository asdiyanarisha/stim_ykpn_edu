<?php

use Illuminate\Support\Facades\Route;
use App\Models\ContentBanner;
use App\Models\News;
use App\Models\Teacher;
use App\Models\CategoryTeacher;


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

Route::get('/', function () {
    $banners = ContentBanner::orderBy('created_at', 'desc')->get();
    $latest_news = News::where('status', 'published')->orderBy('created_at', 'desc')->take(3)->get();
    return view('index', compact('banners', 'latest_news'));
});

Route::get('/berita/{id}', function ($id) {
    $news = News::findOrFail($id);
    if ($news->status !== 'published') {
        abort(404);
    }
    $news->increment('views_count');
    return view('berita-detail', compact('news'));
});

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
    return view('berita');
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
    return view('facility-form');
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
Route::get('/sambutan-ketua', function () {
    $greeting = \App\Models\GreetingChief::first();
    return view('sambutan-ketua', compact('greeting'));
});
Route::get('/sambutan-ketua.html', function () {
    $greeting = \App\Models\GreetingChief::first();
    return view('sambutan-ketua', compact('greeting'));
});

Route::get('/visi-misi', fn() => view('visi-misi'));
Route::get('/visi-misi.html', fn() => view('visi-misi'));

Route::get('/profil', fn() => view('profil'));
Route::get('/profil.html', fn() => view('profil'));

Route::get('/logo', fn() => view('logo'));
Route::get('/logo.html', fn() => view('logo'));

Route::get('/dosen', function (\Illuminate\Http\Request $request) {
    $categories = CategoryTeacher::all();
    
    $query = Teacher::query();
    
    if ($request->has('category') && $request->category != 'all') {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('full_name', 'like', "%{$search}%")
              ->orWhere('front_title', 'like', "%{$search}%")
              ->orWhere('back_title', 'like', "%{$search}%")
              ->orWhereHas('category', function($cq) use ($search) {
                  $cq->where('title', 'like', "%{$search}%");
              })
              ->orWhereHas('jobTitle', function($jq) use ($search) {
                  $jq->where('title', 'like', "%{$search}%");
              });
        });
    }
    
    $teachers = $query->with(['category', 'jobTitle'])->paginate(6);
    
    return view('dosen', compact('teachers', 'categories'));
});

Route::get('/dosen/{id}', function ($id) {
    $teacher = Teacher::with([
        'category', 
        'jobTitle', 
        'education',
        'professional_positions',
        'research_areas',
        'publications',
        'books',
        'popular_writings',
        'awards',
        'online_academic_profiles',
    ])->findOrFail($id);

    return view('dosen-detail', compact('teacher'));
});

Route::get('/dosen/{id}.html', function ($id) {
    $teacher = Teacher::with([
        'category', 
        'jobTitle', 
        'education',
        'professional_positions',
        'research_areas',
        'publications',
        'books',
        'popular_writings',
        'awards',
        'online_academic_profiles',
    ])->findOrFail($id);

    return view('dosen-detail', compact('teacher'));
});



Route::get('/dosen.html', function (\Illuminate\Http\Request $request) {
    $categories = CategoryTeacher::all();
    
    $query = Teacher::query();
    
    if ($request->has('category') && $request->category != 'all') {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('full_name', 'like', "%{$search}%")
              ->orWhere('front_title', 'like', "%{$search}%")
              ->orWhere('back_title', 'like', "%{$search}%")
              ->orWhereHas('category', function($cq) use ($search) {
                  $cq->where('title', 'like', "%{$search}%");
              })
              ->orWhereHas('jobTitle', function($jq) use ($search) {
                  $jq->where('title', 'like', "%{$search}%");
              });
        });
    }
    
    $teachers = $query->with(['category', 'jobTitle'])->paginate(6);
    
    return view('dosen', compact('teachers', 'categories'));
});

$pimpinanHandler = function () {
    $pimpinans = \App\Models\Teacher::with(['jobTitle', 'category'])
        ->whereHas('category', function($q) {
            $q->where('title', 'like', '%Pimpinan%')
              ->orWhere('slug', 'like', '%pimpinan%');
        })
        ->get();
        
    // Sort pimpinans: "Ketua" first, then the rest.
    $pimpinans = $pimpinans->sortBy(function($p) {
        $title = $p->jobTitle ? strtolower($p->jobTitle->title) : '';
        if (strpos($title, 'ketua') !== false && strpos($title, 'wakil') === false) {
            return 0; // Ketua
        }
        return 1; // Others
    });

    return view('pimpinan', compact('pimpinans'));
};

Route::get('/pimpinan', $pimpinanHandler);
Route::get('/pimpinan.html', $pimpinanHandler);

Route::get('/fasilitas', fn() => view('fasilitas'));
Route::get('/fasilitas.html', fn() => view('fasilitas'));

Route::get('/prestasi', fn() => view('prestasi'));
Route::get('/prestasi.html', fn() => view('prestasi'));

Route::get('/spmi', fn() => view('spmi'));
Route::get('/spmi.html', fn() => view('spmi'));

// Academic Program Study Sub-Pages (Modular Blade)
Route::get('/sasaran-pendidikan', fn() => view('sasaran-pendidikan'));
Route::get('/sasaran-pendidikan.html', fn() => view('sasaran-pendidikan'));

Route::get('/cara-mencapai-sasaran', fn() => view('cara-mencapai-sasaran'));
Route::get('/cara-mencapai-sasaran.html', fn() => view('cara-mencapai-sasaran'));

Route::get('/beban-studi', fn() => view('beban-studi'));
Route::get('/beban-studi.html', fn() => view('beban-studi'));

Route::get('/sks', fn() => view('sks'));
Route::get('/sks.html', fn() => view('sks'));

Route::get('/jenjang-studi', fn() => view('jenjang-studi'));
Route::get('/jenjang-studi.html', fn() => view('jenjang-studi'));

Route::get('/kegiatan-akademik', fn() => view('kegiatan-akademik'));
Route::get('/kegiatan-akademik.html', fn() => view('kegiatan-akademik'));

Route::get('/dosen-pembimbing', fn() => view('dosen-pembimbing'));
Route::get('/dosen-pembimbing.html', fn() => view('dosen-pembimbing'));

Route::get('/sanksi-akademik', fn() => view('sanksi-akademik'));
Route::get('/sanksi-akademik.html', fn() => view('sanksi-akademik'));

// Newly Migrated Academic & Provision Pages
Route::get('/kalender-akademik', fn() => view('kalender-akademik'));
Route::get('/kalender-akademik.html', fn() => view('kalender-akademik'));

Route::get('/kehadiran-kuliah', fn() => view('kehadiran-kuliah'));
Route::get('/kehadiran-kuliah.html', fn() => view('kehadiran-kuliah'));

Route::get('/tata-tertib-kuliah', fn() => view('tata-tertib-kuliah'));
Route::get('/tata-tertib-kuliah.html', fn() => view('tata-tertib-kuliah'));

Route::get('/jumlah-kehadiran', fn() => view('jumlah-kehadiran'));
Route::get('/jumlah-kehadiran.html', fn() => view('jumlah-kehadiran'));

Route::get('/seminar-proposal', fn() => view('seminar-proposal'));
Route::get('/seminar-proposal.html', fn() => view('seminar-proposal'));

Route::get('/ketentuan-ujian', fn() => view('ketentuan-ujian'));
Route::get('/ketentuan-ujian.html', fn() => view('ketentuan-ujian'));

Route::get('/tata-tertib-ujian', fn() => view('tata-tertib-ujian'));
Route::get('/tata-tertib-ujian.html', fn() => view('tata-tertib-ujian'));

Route::get('/kelulusan', fn() => view('kelulusan'));
Route::get('/kelulusan.html', fn() => view('kelulusan'));

Route::get('/yudisium', fn() => view('yudisium'));
Route::get('/yudisium.html', fn() => view('yudisium'));

Route::get('/perpustakaan', fn() => view('perpustakaan'));
Route::get('/perpustakaan.html', fn() => view('perpustakaan'));

// PMB Admin Dashboard
Route::get('/pmb', fn() => view('pmb-admin'))->name('pmb.admin.index');
Route::get('/pmb/show/{id}', fn() => view('pmb-admin-show'))->name('pmb.admin.show');
Route::get('/pmb/edit/{id}', fn() => view('pmb-admin-edit'))->name('pmb.admin.edit');

// Newly Migrated PMB Landing Pages
Route::get('/pmb.html', fn() => view('pmb'));

Route::get('/biaya-kuliah', fn() => view('biaya-kuliah'));
Route::get('/biaya-kuliah.html', fn() => view('biaya-kuliah'));

Route::get('/beasiswa', fn() => view('beasiswa'));
Route::get('/beasiswa.html', fn() => view('beasiswa'));

Route::get('/program-reguler', fn() => view('program-reguler'));
Route::get('/program-reguler.html', fn() => view('program-reguler'));

Route::get('/program-ekstensi', fn() => view('program-ekstensi'));
Route::get('/program-ekstensi.html', fn() => view('program-ekstensi'));

Route::get('/pengumuman-diterima', fn() => view('pengumuman-diterima'));
Route::get('/pengumuman-diterima.html', fn() => view('pengumuman-diterima'));

// Batch 3 - Student, Campus Life, and Information Pages
Route::get('/kegiatan-mahasiswa', fn() => view('kegiatan-mahasiswa'));
Route::get('/kegiatan-mahasiswa.html', fn() => view('kegiatan-mahasiswa'));
Route::get('/ppkpt', fn() => view('ppkpt'));
Route::get('/ppkpt.html', fn() => view('ppkpt'));
Route::get('/pengumuman', fn() => view('pengumuman'));
Route::get('/pengumuman.html', fn() => view('pengumuman'));

Route::get('/ukm', fn() => view('ukm'));
Route::get('/ukm.html', fn() => view('ukm'));

Route::get('/video', fn() => view('video'));
Route::get('/video.html', fn() => view('video'));

Route::get('/informasi-tempat-tinggal', fn() => view('informasi-tempat-tinggal'));
Route::get('/informasi-tempat-tinggal.html', fn() => view('informasi-tempat-tinggal'));

Route::get('/brosur', fn() => view('brosur'));
Route::get('/brosur.html', fn() => view('brosur'));

Route::get('/unduh', fn() => view('unduh'));
Route::get('/unduh.html', fn() => view('unduh'));

Route::get('/alumni', fn() => view('alumni'));
Route::get('/alumni.html', fn() => view('alumni'));

Route::get('/lowongan-kerja', fn() => view('lowongan-kerja'));
Route::get('/lowongan-kerja.html', fn() => view('lowongan-kerja'));

Route::get('/whatsapp-contact', fn() => view('whatsapp-contact'))->name('whatsapp-contact.index');

Route::get('/kalender-akademik', function () {
    $calendar = \App\Models\AcademicCalendar::first();
    return view('kalender-akademik', compact('calendar'));
});
Route::get('/kalender-akademik.html', function () {
    $calendar = \App\Models\AcademicCalendar::first();
    return view('kalender-akademik', compact('calendar'));
});

Route::get('/logo', fn() => view('logo'));
Route::get('/logo.html', fn() => view('logo'));

Route::get('/berita', function () {
    $newsList = \App\Models\News::orderBy('created_at', 'desc')->paginate(12);
    return view('berita', compact('newsList'));
});
Route::get('/berita.html', function () {
    $newsList = \App\Models\News::orderBy('created_at', 'desc')->paginate(12);
    return view('berita', compact('newsList'));
});

Route::get('/api/inspect-data', function() {
    return \App\Models\CategoryTeacher::all();
});
