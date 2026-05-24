<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        try {
            $roles = Role::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $roles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created role record.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:roles',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Role berhasil dibuat',
                'data' => $role
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified role record.
     */
    public function update(Request $request, $id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Role tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:roles,name,' . $id,
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $role->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Role berhasil diperbarui',
                'data' => $role
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified role record.
     */
    public function destroy($id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Role tidak ditemukan'
                ], 404);
            }

            if ($role->name === 'administrator') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Role administrator tidak dapat dihapus'
                ], 403);
            }

            $role->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Role berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete roles.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            // Prevent deleting administrator
            $hasAdmin = Role::whereIn('id', $ids)->where('name', 'administrator')->exists();
            if ($hasAdmin) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terdapat role administrator dalam pilihan. Role administrator tidak dapat dihapus.'
                ], 403);
            }

            Role::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Role berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus role: ' . $e->getMessage()
            ], 500);
        }
    }
}
