<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateTeacherData($request);

        try {
            $teacherId = DB::transaction(function () use ($validatedData, $request) {
                $now = now();

                $storedImageUrl = $validatedData['image_url'] ?? '';
                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('teachers', 'public');
                    $storedImageUrl = Storage::url($path);
                }

                $teacherId = DB::table('teachers')->insertGetId([
                    'user_id' => $validatedData['user_id'] ?? 0,
                    'full_name' => $validatedData['full_name'],
                    'front_title' => $validatedData['front_title'] ?? null,
                    'back_title' => $validatedData['back_title'] ?? null,
                    'birth_date' => $validatedData['birth_date'] ?? null,
                    'email' => $validatedData['email'],
                    'phone_number' => $validatedData['phone_number'],
                    'address' => $validatedData['address'],
                    'personal_description' => $validatedData['personal_description'] ?? null,
                    'image_url' => $storedImageUrl,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                if (!empty($validatedData['education'])) {
                    $rows = [];
                    foreach ($validatedData['education'] as $item) {
                        $rows[] = [
                            'teacher_id' => $teacherId,
                            'degree' => $item['degree'],
                            'institution' => $item['institution'],
                            'major' => $item['major'] ?? null,
                            'country' => $item['country'] ?? null,
                            'graduation_year' => $item['graduation_year'] ?? null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('education_teachers')->insert($rows);
                }

                if (!empty($validatedData['professional_positions'])) {
                    $rows = [];
                    foreach ($validatedData['professional_positions'] as $item) {
                        $rows[] = [
                            'teacher_id' => $teacherId,
                            'position_name' => $item['position_name'],
                            'organization_name' => $item['organization_name'],
                            'start_year' => $item['start_year'] ?? null,
                            'end_year' => $item['end_year'] ?? null,
                            'is_current' => $item['is_current'] ?? null,
                            'description' => $item['description'] ?? null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('professional_positions_teachers')->insert($rows);
                }

                if (!empty($validatedData['research_areas'])) {
                    $rows = [];
                    foreach ($validatedData['research_areas'] as $item) {
                        $rows[] = [
                            'teacher_id' => $teacherId,
                            'area_name' => $item['area_name'] ?? null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('research_areas_teachers')->insert($rows);
                }

                if (!empty($validatedData['publications'])) {
                    $rows = [];
                    foreach ($validatedData['publications'] as $item) {
                        $rows[] = [
                            'teacher_id' => $teacherId,
                            'title' => $item['title'] ?? null,
                            'journal_book_name' => $item['journal_book_name'] ?? null,
                            'type' => $item['type'] ?? null,
                            'volume' => $item['volume'] ?? null,
                            'pages' => $item['pages'] ?? null,
                            'year' => $item['year'] ?? null,
                            'doi' => $item['doi'] ?? null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('publications_teachers')->insert($rows);
                }

                if (!empty($validatedData['books'])) {
                    $rows = [];
                    foreach ($validatedData['books'] as $item) {
                        $rows[] = [
                            'teacher_id' => $teacherId,
                            'title' => $item['title'] ?? null,
                            'publisher' => $item['publisher'] ?? null,
                            'year' => $item['year'] ?? null,
                            'isbn' => $item['isbn'] ?? null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('books_teachers')->insert($rows);
                }

                if (!empty($validatedData['popular_writings'])) {
                    $rows = [];
                    foreach ($validatedData['popular_writings'] as $item) {
                        $rows[] = [
                            'teacher_id' => $teacherId,
                            'title' => $item['title'] ?? null,
                            'media' => $item['media'] ?? null,
                            'date' => $item['date'] ?? null,
                            'url' => $item['url'] ?? null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('popular_writings_teachers')->insert($rows);
                }

                if (!empty($validatedData['awards'])) {
                    $rows = [];
                    foreach ($validatedData['awards'] as $item) {
                        $rows[] = [
                            'teacher_id' => $teacherId,
                            'award_name' => $item['award_name'] ?? null,
                            'grantor' => $item['grantor'] ?? null,
                            'year' => $item['year'] ?? null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('awards_teachers')->insert($rows);
                }

                if (!empty($validatedData['online_academic_profiles'])) {
                    $rows = [];
                    foreach ($validatedData['online_academic_profiles'] as $item) {
                        $rows[] = [
                            'teacher_id' => $teacherId,
                            'platform_name' => $item['platform_name'] ?? null,
                            'url' => $item['url'] ?? null,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('online_academic_profiles_teachers')->insert($rows);
                }

                return $teacherId;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data dosen berhasil disimpan ke database.',
                'teacher_id' => $teacherId,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data dosen.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Helper validasi untuk data dosen
     */
    private function validateTeacherData(Request $request)
    {
        $arrayFields = [
            'education',
            'research_areas',
            'publications',
            'books',
            'popular_writings',
            'professional_positions',
            'awards',
            'online_academic_profiles',
        ];

        foreach ($arrayFields as $field) {
            if ($request->has($field) && is_string($request->input($field))) {
                $decoded = json_decode($request->input($field), true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $request->merge([$field => $decoded]);
                }
            }
        }

        // Normalisasi nilai kosong agar validasi/insert konsisten
        $professionalPositions = $request->input('professional_positions');
        if (is_array($professionalPositions)) {
            foreach ($professionalPositions as $i => $position) {
                $isCurrent = filter_var($position['is_current'] ?? false, FILTER_VALIDATE_BOOLEAN);
                $endYear = $position['end_year'] ?? null;

                if ($isCurrent || $endYear === '') {
                    $professionalPositions[$i]['end_year'] = null;
                }

                if (($position['start_year'] ?? null) === '') {
                    $professionalPositions[$i]['start_year'] = null;
                }
            }
            $request->merge(['professional_positions' => $professionalPositions]);
        }

        return $request->validate([
            'user_id' => 'nullable|integer',
            'full_name' => 'required|string|max:255',
            'front_title' => 'nullable|string|max:50',
            'back_title' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'personal_description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url' => 'nullable|string|max:255',
            
            // Array validasi (Harus minimal 1 data)
            'education' => 'required|array|min:1',
            'education.*.degree' => 'required|string|max:100',
            'education.*.institution' => 'required|string|max:255',
            'education.*.major' => 'nullable|string|max:255',
            'education.*.country' => 'nullable|string|max:100',
            'education.*.graduation_year' => 'nullable|string|max:4',

            'research_areas' => 'nullable|array',
            'research_areas.*.area_name' => 'nullable|string|max:255',

            'publications' => 'nullable|array',
            'publications.*.title' => 'nullable|string|max:255',
            'publications.*.journal_book_name' => 'nullable|string|max:255',
            'publications.*.type' => 'nullable|string|max:100',
            'publications.*.volume' => 'nullable|string|max:50',
            'publications.*.pages' => 'nullable|string|max:50',
            'publications.*.year' => 'nullable|string|max:4',
            'publications.*.doi' => 'nullable|string|max:255',

            'books' => 'nullable|array',
            'books.*.title' => 'nullable|string|max:255',
            'books.*.publisher' => 'nullable|string|max:255',
            'books.*.year' => 'nullable|string|max:4',
            'books.*.isbn' => 'nullable|string|max:100',

            'popular_writings' => 'nullable|array',
            'popular_writings.*.title' => 'nullable|string|max:255',
            'popular_writings.*.media' => 'nullable|string|max:255',
            'popular_writings.*.date' => 'nullable|date',
            'popular_writings.*.url' => 'nullable|url',

            'professional_positions' => 'required|array|min:1',
            'professional_positions.*.position_name' => 'required|string|max:255',
            'professional_positions.*.organization_name' => 'required|string|max:255',
            'professional_positions.*.start_year' => 'nullable|string|max:4',
            'professional_positions.*.end_year' => 'nullable|string|max:4',
            'professional_positions.*.is_current' => 'nullable|boolean',
            'professional_positions.*.description' => 'nullable|string',

            'awards' => 'nullable|array',
            'awards.*.award_name' => 'nullable|string|max:255',
            'awards.*.grantor' => 'nullable|string|max:255',
            'awards.*.year' => 'nullable|string|max:4',

            'online_academic_profiles' => 'nullable|array',
            'online_academic_profiles.*.platform_name' => 'nullable|string|max:255',
            'online_academic_profiles.*.url' => 'nullable|url',
        ]);
    }
}
