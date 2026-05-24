<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WhatsappContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WhatsappContactController extends Controller
{
    /**
     * Display all WhatsApp contacts.
     */
    public function index()
    {
        try {
            $contacts = WhatsappContact::orderBy('id', 'asc')->get();

            return response()->json([
                'status' => 'success',
                'data' => $contacts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data kontak WhatsApp: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Save/Sync all WhatsApp contacts.
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'contacts' => 'present|array',
                'contacts.*.nama' => 'required|string|max:255',
                'contacts.*.no_whatsapp' => 'required|string|max:50',
                'contacts.*.is_main' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $contactsData = $request->input('contacts', []);

            // Check that is_main is not more than 1
            $mainCount = 0;
            foreach ($contactsData as $contact) {
                if (!empty($contact['is_main'])) {
                    $mainCount++;
                }
            }

            if ($mainCount > 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nomor utama tidak boleh lebih dari 1'
                ], 422);
            }

            // Perform in transaction to ensure atomic updates
            DB::beginTransaction();

            // Clear existing contacts
            WhatsappContact::query()->delete();

            // Insert new contacts
            foreach ($contactsData as $contact) {
                WhatsappContact::create([
                    'nama' => $contact['nama'],
                    'no_whatsapp' => $contact['no_whatsapp'],
                    'is_main' => (bool)$contact['is_main'],
                ]);
            }

            DB::commit();

            // Retrieve updated contacts
            $updatedContacts = WhatsappContact::orderBy('id', 'asc')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Kontak WhatsApp berhasil disimpan',
                'data' => $updatedContacts
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan kontak WhatsApp: ' . $e->getMessage()
            ], 500);
        }
    }
}
