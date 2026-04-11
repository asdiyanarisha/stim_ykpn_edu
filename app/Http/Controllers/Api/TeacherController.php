<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    /**
     * Store a newly created resource.
     * Saat ini hanya untuk mencetak data form ke file Laravel Log (storage/logs/laravel.log).
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateTeacherData($request);

        // Mencetak seluruh payload request ke log
        Log::info('===== PENAMBAHAN DATA DOSEN BARU =====');
        Log::info(json_encode($request->all(), JSON_PRETTY_PRINT));
        Log::info('======================================');

        return response()->json([
            'status' => 'success',
            'message' => 'Data dosen berhasil diterima (Mock/Log mode). Silakan cek file storage/logs/laravel.log'
        ], 200);
    }

    /**
     * Helper validasi untuk data dosen
     */
    private function validateTeacherData(Request $request)
    {
        return $request->validate([
            'full_name' => 'required|string|max:255',
            'front_title' => 'nullable|string|max:50',
            'back_title' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'personal_description' => 'nullable|string',
            
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
