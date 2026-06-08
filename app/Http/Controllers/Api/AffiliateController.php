<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    /**
     * Display a listing of affiliates.
     */
    public function index()
    {
        try {
            $affiliates = DB::table('affiliates as a')
                ->leftJoin('users as u', 'u.id', '=', 'a.user_id')
                ->select(
                    'a.id',
                    'a.name',
                    'a.phone_number',
                    'a.institution',
                    'a.position',
                    'a.city',
                    'a.address',
                    'a.bank_name',
                    'a.account_holder_name',
                    'a.account_number',
                    'a.created_at',
                    'u.name as username',
                    'u.email'
                )
                ->orderByDesc('a.created_at')
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $affiliates,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data affiliate.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified affiliate.
     */
    public function show($id)
    {
        try {
            $affiliate = DB::table('affiliates as a')
                ->leftJoin('users as u', 'u.id', '=', 'a.user_id')
                ->select(
                    'a.id',
                    'a.name',
                    'a.phone_number',
                    'a.institution',
                    'a.position',
                    'a.city',
                    'a.address',
                    'a.bank_name',
                    'a.account_holder_name',
                    'a.account_number',
                    'a.created_at',
                    'u.name as username',
                    'u.email'
                )
                ->where('a.id', $id)
                ->first();

            if (!$affiliate) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data affiliate tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $affiliate,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail affiliate.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created affiliate.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'phone_number' => 'required|string|max:255|unique:affiliates,phone_number',
            'institution' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'bank_name' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $now = now();

                // 1. Create User
                $userId = DB::table('users')->insertGetId([
                    'name' => $validated['username'], // Username stored in name field
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role_id' => 3, // Role affiliate
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // 2. Create Affiliate
                DB::table('affiliates')->insert([
                    'user_id' => $userId,
                    'name' => $validated['name'],
                    'phone_number' => $validated['phone_number'],
                    'institution' => $validated['institution'],
                    'position' => $validated['position'] ?? null,
                    'city' => $validated['city'],
                    'address' => $validated['address'],
                    'bank_name' => $validated['bank_name'] ?? null,
                    'account_holder_name' => $validated['account_holder_name'] ?? null,
                    'account_number' => $validated['account_number'] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data affiliate berhasil disimpan.',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data affiliate.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified affiliate in storage.
     */
    public function update(Request $request, $id)
    {
        $affiliate = DB::table('affiliates')->where('id', $id)->first();
        if (!$affiliate) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data affiliate tidak ditemukan.',
            ], 404);
        }

        $userId = $affiliate->user_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,name,' . $userId,
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'phone_number' => 'required|string|max:255|unique:affiliates,phone_number,' . $id,
            'institution' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'bank_name' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        try {
            DB::transaction(function () use ($validated, $id, $userId) {
                $now = now();

                // 1. Update User
                $userData = [
                    'name' => $validated['username'],
                    'email' => $validated['email'],
                    'updated_at' => $now,
                ];

                if (!empty($validated['password'])) {
                    $userData['password'] = Hash::make($validated['password']);
                }

                DB::table('users')->where('id', $userId)->update($userData);

                // 2. Update Affiliate
                DB::table('affiliates')->where('id', $id)->update([
                    'name' => $validated['name'],
                    'phone_number' => $validated['phone_number'],
                    'institution' => $validated['institution'],
                    'position' => $validated['position'] ?? null,
                    'city' => $validated['city'],
                    'address' => $validated['address'],
                    'bank_name' => $validated['bank_name'] ?? null,
                    'account_holder_name' => $validated['account_holder_name'] ?? null,
                    'account_number' => $validated['account_number'] ?? null,
                    'updated_at' => $now,
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data affiliate berhasil diperbarui.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui data affiliate.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified affiliate.
     */
    public function destroy($id)
    {
        try {
            $affiliate = DB::table('affiliates')->where('id', $id)->first();
            if (!$affiliate) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data affiliate tidak ditemukan.',
                ], 404);
            }

            DB::transaction(function () use ($id, $affiliate) {
                // Delete user first (there is no foreign key constraint, but keeps DB clean)
                DB::table('users')->where('id', $affiliate->user_id)->delete();
                
                // Delete affiliate record
                DB::table('affiliates')->where('id', $id)->delete();
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data affiliate berhasil dihapus.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data affiliate.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Bulk delete affiliates.
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!is_array($ids) || empty($ids)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pilihan data tidak valid.',
            ], 400);
        }

        try {
            DB::transaction(function () use ($ids) {
                $userIds = DB::table('affiliates')->whereIn('id', $ids)->pluck('user_id')->toArray();
                
                // Delete users
                DB::table('users')->whereIn('id', $userIds)->delete();

                // Delete affiliates
                DB::table('affiliates')->whereIn('id', $ids)->delete();
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data affiliate terpilih berhasil dihapus.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data affiliate terpilih.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
