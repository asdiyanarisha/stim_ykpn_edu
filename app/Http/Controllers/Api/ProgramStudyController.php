<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudy;
use App\Models\ProgramStudyConcentration;
use App\Models\ProgramStudyCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgramStudyController extends Controller
{
    /**
     * List all program studies (with concentrations & careers).
     */
    public function index()
    {
        try {
            $programs = ProgramStudy::with(['concentrations', 'careers'])
                ->orderBy('order')
                ->orderBy('created_at', 'desc')
                ->get();
            return response()->json(['status' => 'success', 'data' => $programs]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal mengambil data program studi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show by ID or slug.
     */
    public function show($identifier)
    {
        try {
            $program = is_numeric($identifier)
                ? ProgramStudy::with(['concentrations', 'careers'])->find($identifier)
                : ProgramStudy::with(['concentrations', 'careers'])->where('slug', $identifier)->first();

            if (!$program) {
                return response()->json(['status' => 'error', 'message' => 'Program studi tidak ditemukan'], 404);
            }
            return response()->json(['status' => 'success', 'data' => $program]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal mengambil detail program studi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Create new program study with concentrations & careers.
     */
    public function store(Request $request)
    {
        // Decode JSON arrays if sent via FormData
        if ($request->has('concentrations') && is_string($request->concentrations)) {
            $request->merge(['concentrations' => json_decode($request->concentrations, true)]);
        }
        if ($request->has('careers') && is_string($request->careers)) {
            $request->merge(['careers' => json_decode($request->careers, true)]);
        }

        $validator = Validator::make($request->all(), [
            'name'             => 'required|string|max:255',
            'grade'            => 'required|string|max:50',
            'slug'             => 'required|string|max:100|unique:program_studies,slug',
            'spa_fee'          => 'nullable|integer|min:0',
            'spa_fee_fixed'    => 'nullable|integer|min:0',
            'spa_fee_variable' => 'nullable|integer|min:0',
            'tagline'          => 'nullable|string',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'study_duration'   => 'nullable|string|max:50',
            'degree_title'     => 'nullable|string|max:50',
            'total_sks'        => 'nullable|integer|min:0',
            'accreditation'    => 'nullable|string|max:100',
            'is_active'        => 'nullable|boolean',
            'order'            => 'nullable|integer',
            'concentrations'   => 'nullable|array',
            'concentrations.*.name'        => 'required|string|max:255',
            'concentrations.*.description' => 'nullable|string',
            'concentrations.*.icon'        => 'nullable|string|max:100',
            'concentrations.*.order'       => 'nullable|integer',
            'careers'          => 'nullable|array',
            'careers.*.title'       => 'required|string|max:255',
            'careers.*.description' => 'nullable|string',
            'careers.*.order'       => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $data = $request->except(['concentrations', 'careers', 'image']);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('program_banners', 'public');
                $data['image_banner'] = asset(Storage::url($path));
            }

            $program = ProgramStudy::create($data);

            if ($request->has('concentrations')) {
                foreach ($request->concentrations as $idx => $c) {
                    $program->concentrations()->create(array_merge($c, ['order' => $c['order'] ?? $idx]));
                }
            }
            if ($request->has('careers')) {
                foreach ($request->careers as $idx => $c) {
                    $program->careers()->create(array_merge($c, ['order' => $c['order'] ?? $idx]));
                }
            }

            DB::commit();
            return response()->json([
                'status'  => 'success',
                'message' => 'Program studi berhasil ditambahkan',
                'data'    => $program->load(['concentrations', 'careers']),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Gagal menambahkan program studi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update program study along with its concentrations & careers.
     */
    public function update(Request $request, $id)
    {
        $program = ProgramStudy::find($id);
        if (!$program) {
            return response()->json(['status' => 'error', 'message' => 'Program studi tidak ditemukan'], 404);
        }

        // Decode JSON arrays if sent via FormData
        if ($request->has('concentrations') && is_string($request->concentrations)) {
            $request->merge(['concentrations' => json_decode($request->concentrations, true)]);
        }
        if ($request->has('careers') && is_string($request->careers)) {
            $request->merge(['careers' => json_decode($request->careers, true)]);
        }

        $validator = Validator::make($request->all(), [
            'name'             => 'required|string|max:255',
            'grade'            => 'required|string|max:50',
            'slug'             => 'required|string|max:100|unique:program_studies,slug,' . $id,
            'spa_fee'          => 'nullable|integer|min:0',
            'spa_fee_fixed'    => 'nullable|integer|min:0',
            'spa_fee_variable' => 'nullable|integer|min:0',
            'tagline'          => 'nullable|string',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'study_duration'   => 'nullable|string|max:50',
            'degree_title'     => 'nullable|string|max:50',
            'total_sks'        => 'nullable|integer|min:0',
            'accreditation'    => 'nullable|string|max:100',
            'is_active'        => 'nullable|boolean',
            'order'            => 'nullable|integer',
            'concentrations'   => 'nullable|array',
            'concentrations.*.name'        => 'required|string|max:255',
            'concentrations.*.description' => 'nullable|string',
            'concentrations.*.icon'        => 'nullable|string|max:100',
            'concentrations.*.order'       => 'nullable|integer',
            'careers'          => 'nullable|array',
            'careers.*.title'       => 'required|string|max:255',
            'careers.*.description' => 'nullable|string',
            'careers.*.order'       => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $data = $request->except(['concentrations', 'careers', 'image']);

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($program->image_banner && str_contains($program->image_banner, '/storage/program_banners/')) {
                    $oldPath = 'program_banners/' . basename($program->image_banner);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('program_banners', 'public');
                $data['image_banner'] = asset(Storage::url($path));
            }

            $program->update($data);

            // Sync concentrations: hapus semua lama, insert baru
            if ($request->has('concentrations')) {
                $program->concentrations()->delete();
                foreach ($request->concentrations as $idx => $c) {
                    $program->concentrations()->create(array_merge($c, ['order' => $c['order'] ?? $idx]));
                }
            }

            // Sync careers
            if ($request->has('careers')) {
                $program->careers()->delete();
                foreach ($request->careers as $idx => $c) {
                    $program->careers()->create(array_merge($c, ['order' => $c['order'] ?? $idx]));
                }
            }

            DB::commit();
            return response()->json([
                'status'  => 'success',
                'message' => 'Program studi berhasil diperbarui',
                'data'    => $program->load(['concentrations', 'careers']),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui program studi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete a program study (cascades to concentrations & careers via delete).
     */
    public function destroy($id)
    {
        try {
            $program = ProgramStudy::find($id);
            if (!$program) {
                return response()->json(['status' => 'error', 'message' => 'Program studi tidak ditemukan'], 404);
            }
            $program->concentrations()->delete();
            $program->careers()->delete();
            $program->delete();

            return response()->json(['status' => 'success', 'message' => 'Program studi berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus program studi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Bulk delete program studies.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }
            ProgramStudyConcentration::whereIn('program_study_id', $ids)->delete();
            ProgramStudyCareer::whereIn('program_study_id', $ids)->delete();
            ProgramStudy::whereIn('id', $ids)->delete();

            return response()->json(['status' => 'success', 'message' => 'Program studi terpilih berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus program studi: ' . $e->getMessage()], 500);
        }
    }
}
