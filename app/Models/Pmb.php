<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmb extends Model
{
    use HasFactory;

    protected $table = 'pmb';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_hp_wa',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat_asal',
        'asal_sekolah',
        'program_studi',
        'sumber_informasi',
        'jalur_registrasi',
        'kode_voucher',
    ];
}
