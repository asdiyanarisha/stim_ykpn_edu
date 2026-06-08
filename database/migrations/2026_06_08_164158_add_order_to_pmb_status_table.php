<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tambahkan kolom `order` untuk menentukan urutan tampil di timeline
     * tanpa mengubah ID yang sudah digunakan di tabel pmb.
     */
    public function up(): void
    {
        Schema::table('pmb_status', function (Blueprint $table) {
            $table->unsignedInteger('order')->default(0)->after('slug');
        });

        // Set urutan: Sedang Mengirim Email jadi step 1 (paling awal)
        // Order: Sedang Mengirim Email > Registrasi Awal > Menunggu Pembayaran > ... dst
        DB::table('pmb_status')->where('slug', 'sedang-mengirim-email')->update(['order' => 1]);
        DB::table('pmb_status')->where('slug', 'registrasi-awal')->update(['order' => 2]);
        DB::table('pmb_status')->where('slug', 'menunggu-pembayaran')->update(['order' => 3]);
        DB::table('pmb_status')->where('slug', 'pembayaran-dikonfirmasi')->update(['order' => 4]);
        DB::table('pmb_status')->where('slug', 'registrasi-ulang')->update(['order' => 5]);
        DB::table('pmb_status')->where('slug', 'menunggu-konfirmasi-pendaftaran')->update(['order' => 6]);
        DB::table('pmb_status')->where('slug', 'diterima')->update(['order' => 7]);
        DB::table('pmb_status')->where('slug', 'gagal-mengirim-email')->update(['order' => 8]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pmb_status', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
