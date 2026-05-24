<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'header_image',
    ];
}
