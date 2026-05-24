<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicSanction extends Model
{
    use HasFactory;

    protected $table = 'academic_sanctions';

    protected $fillable = [
        'title',
        'content',
        'header_image',
    ];
}
