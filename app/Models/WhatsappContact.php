<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappContact extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_contacts';

    protected $fillable = [
        'nama',
        'no_whatsapp',
        'is_main',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];
}
