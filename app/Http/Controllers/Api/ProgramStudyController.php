<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramStudyController extends Controller
{
    /**
     * Display a listing of the program studies.
     */
    public function index()
    {
        try {
            $programs = ProgramStudy::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $programs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data program studi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created program study.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'grade' => 'required|string|max:255',
                'spa_fee' => 'required|integer|min:0',
                'spa_fee_fixed' => 'required|integer|min:0',
                'spa_fee_variable' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $program = ProgramStudy::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Program studi berhasil ditambahkan',
                'data' => $program
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan program studi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified program study.
     */
    public function show($id)
    {
        try {
            $program = ProgramStudy::find($id);

            if (!$program) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Program studi tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $program
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail program studi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified program study.
     */
    public function update(Request $request, $id)
    {
        try {
            $program = ProgramStudy::find($id);

            if (!$program) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Program studi tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'grade' => 'required|string|max:255',
                'spa_fee' => 'required|integer|min:0',
                'spa_fee_fixed' => 'required|integer|min:0',
                'spa_fee_variable' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $program->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Program studi berhasil diperbarui',
                'data' => $program
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui program studi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified program study.
     */
    public function destroy($id)
    {
        try {
            $program = ProgramStudy::find($id);

            if (!$program) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Program studi tidak ditemukan'
                ], 404);
            }

            $program->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Program studi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus program studi: ' . $e->getMessage()
            ], 500);
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

            ProgramStudy::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Program studi terpilih berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus program studi: ' . $e->getMessage()
            ], 500);
        }
    }
}
