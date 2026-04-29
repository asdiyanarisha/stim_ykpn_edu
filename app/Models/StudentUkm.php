<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentUkm extends Model
{
    use HasFactory;

    protected $table = 'student_ukm';

    protected $fillable = [
        'title',
        'content',
        'day',
        'time',
        'location',
        'header_image',
    ];
}
