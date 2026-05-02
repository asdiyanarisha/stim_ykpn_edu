<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    /**
     * Display a listing of the vouchers.
     */
    public function index()
    {
        try {
            $vouchers = Voucher::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $vouchers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data voucher: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created voucher.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'code_coupon' => 'nullable|string|max:100',
                'discount_amount' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $voucher = Voucher::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Voucher berhasil ditambahkan',
                'data' => $voucher
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan voucher: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified voucher.
     */
    public function show($id)
    {
        try {
            $voucher = Voucher::find($id);

            if (!$voucher) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Voucher tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $voucher
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail voucher: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified voucher.
     */
    public function update(Request $request, $id)
    {
        try {
            $voucher = Voucher::find($id);

            if (!$voucher) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Voucher tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'code_coupon' => 'nullable|string|max:100',
                'discount_amount' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $voucher->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Voucher berhasil diperbarui',
                'data' => $voucher
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui voucher: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified voucher.
     */
    public function destroy($id)
    {
        try {
            $voucher = Voucher::find($id);

            if (!$voucher) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Voucher tidak ditemukan'
                ], 404);
            }

            $voucher->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Voucher berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus voucher: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete vouchers.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            Voucher::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Voucher terpilih berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus voucher: ' . $e->getMessage()
            ], 500);
        }
    }
}
