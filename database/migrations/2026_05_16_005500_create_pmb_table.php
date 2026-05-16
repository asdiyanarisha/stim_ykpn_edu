<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb', function (Blueprint $table) {
            $table->id();
            
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('nomor_hp_wa', 50); // String pendek untuk nomor HP/WA
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            
            // Pilihan/Dropdown jenis kelamin
            $table->string('jenis_kelamin');
            
            $table->text('alamat_asal'); // Text panjang untuk alamat
            $table->string('asal_sekolah');
            
            // Pilihan/Dropdown program studi
            $table->string('program_studi');
            
            // Pilihan/Dropdown sumber informasi tentang STIM YKPN
            $table->string('sumber_informasi');
            
            // Pilihan/Dropdown jalur registrasi
            $table->string('jalur_registrasi');
            
            // Opsional/bisa null untuk kode voucher
            $table->string('kode_voucher')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pmb');
    }
};
