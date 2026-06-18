<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentBanner;
use App\Models\News;
use App\Models\TestimonyAlumni;
use App\Models\GreetingChief;
use App\Models\CategoryTeacher;
use App\Models\Teacher;
use App\Models\AcademicCalendar;
use App\Models\StudentActivity;
use App\Models\StudentUkm;
use App\Models\Semester;
use App\Models\Kategori;
use App\Models\KegiatanAkademik;
use App\Models\TahunAkademik;
use App\Models\Brochure;
use App\Models\JobVacancy;
use App\Models\ProgramStudy;

class PublicPagesController extends Controller
{
    public function index()
    {
        $banners = ContentBanner::orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        $latest_news = News::where('status', 'published')->orderBy('created_at', 'desc')->take(3)->get();
        $alumnis = TestimonyAlumni::all();
        $programs = ProgramStudy::where('is_active', true)->orderBy('order')->get();
        return view('index', compact('banners', 'latest_news', 'alumnis', 'programs'));
    }

    public function newsDetail($id)
    {
        $news = News::findOrFail($id);
        if ($news->status !== 'published') {
            abort(404);
        }
        $news->increment('views_count');

        $articleSchema = [
            '@context'      => 'https://schema.org',
            '@type'         => 'NewsArticle',
            'headline'      => $news->title,
            'datePublished' => $news->created_at->toIso8601String(),
            'dateModified'  => $news->updated_at->toIso8601String(),
            'image'         => $news->url_image ?: url('/images/img/logo/logo-stim-new.png'),
            'author'        => [
                '@type' => 'Organization',
                'name'  => 'STIM YKPN',
            ],
            'publisher'     => [
                '@type' => 'Organization',
                'name'  => 'STIM YKPN',
                'logo'  => [
                    '@type' => 'ImageObject',
                    'url'   => url('/images/img/logo/logo-stim-new.png'),
                ],
            ],
            'mainEntityOfPage' => url('/berita/' . $news->id),
        ];

        return view('berita-detail', compact('news', 'articleSchema'));
    }

    public function newsList(Request $request)
    {
        $query = News::where('status', 'published');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->category != 'Semua') {
            $category = $request->category;
            $query->where(function($q) use ($category) {
                $q->where('title', 'like', "%{$category}%")
                  ->orWhere('content', 'like', "%{$category}%");
            });
        }

        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $newsList = $query->paginate(12)->withQueryString();
        return view('berita', compact('newsList'));
    }

    public function greeting()
    {
        $greeting = GreetingChief::first();
        return view('sambutan-ketua', compact('greeting'));
    }

    public function teacherList(Request $request)
    {
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

        $teachers = $query->with(['category', 'jobTitle'])->orderBy('full_name', 'asc')->paginate(6);
        return view('dosen', compact('teachers', 'categories'));
    }

    public function teacherDetail($id)
    {
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
    }

    public function pimpinan()
    {
        $pimpinans = Teacher::with(['jobTitle', 'category'])
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
    }

    public function academicCalendar()
    {
        $calendar = AcademicCalendar::first();
        $semesters = Semester::all();
        $kategori = Kategori::all();
        $kegiatans = KegiatanAkademik::where('aktif', true)
            ->orderBy('tanggal_mulai', 'asc')
            ->get();
        $activeYear = TahunAkademik::where('aktif', true)->first();

        return view('kalender-akademik', compact('calendar', 'semesters', 'kategori', 'kegiatans', 'activeYear'));
    }

    public function studentActivities()
    {
        $activities = StudentActivity::where('is_publish', true)->orderBy('created_at', 'desc')->get();
        return view('kegiatan-mahasiswa', compact('activities'));
    }

    public function ukm()
    {
        $ukms = StudentUkm::all();
        return view('ukm', compact('ukms'));
    }

    public function alumni()
    {
        $alumnis = TestimonyAlumni::all();
        return view('alumni', compact('alumnis'));
    }

    public function inspectData()
    {
        return CategoryTeacher::all();
    }

    public function brochure()
    {
        $brochures = Brochure::orderBy('created_at', 'desc')->get();
        return view('brosur', compact('brochures'));
    }

    public function jobVacancies()
    {
        $vacancies = JobVacancy::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('lowongan-kerja', compact('vacancies'));
    }

    public function jobVacancyDetail($id)
    {
        $vacancy = JobVacancy::findOrFail($id);
        if ($vacancy->status !== 'published') {
            abort(404);
        }
        $vacancy->increment('views_count');
        return view('lowongan-kerja-detail', compact('vacancy'));
    }

    public function programDetail($slug)
    {
        if (str_ends_with($slug, '.html')) {
            $slug = substr($slug, 0, -5);
        }

        $program = ProgramStudy::with(['concentrations', 'careers'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $programTitle = $program->name;

        return view('program-detail', compact('program', 'programTitle', 'slug'));
    }
}
