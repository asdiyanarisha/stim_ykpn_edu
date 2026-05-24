<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmiAkreditasi extends Model
{
    use HasFactory;

    protected $table = 'spmi_akreditasi';

    protected $fillable = [
        'dasar_hukum',
        'dokumen_spmi',
        'dokumen_akreditasi',
    ];
}
