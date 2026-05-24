<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentSettingController extends Controller
{
    /**
     * Display the payment settings.
     */
    public function show()
    {
        try {
            $data = PaymentSetting::first();

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data pengaturan pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store or Update the payment settings.
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'register_fee' => 'nullable|integer',
                'pkkmb_fee' => 'nullable|integer',
                'affiliate_point_per_register' => 'nullable|integer',
                'minimal_withdraw_affiliate' => 'nullable|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $currentData = PaymentSetting::first();
            
            $fields = [
                'register_fee' => $request->register_fee,
                'pkkmb_fee' => $request->pkkmb_fee,
                'affiliate_point_per_register' => $request->affiliate_point_per_register,
                'minimal_withdraw_affiliate' => $request->minimal_withdraw_affiliate,
            ];

            if ($currentData) {
                $currentData->update($fields);
                $message = 'Pengaturan pembayaran berhasil diperbarui';
            } else {
                $currentData = PaymentSetting::create($fields);
                $message = 'Pengaturan pembayaran berhasil dibuat';
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $currentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan pengaturan pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }
}
