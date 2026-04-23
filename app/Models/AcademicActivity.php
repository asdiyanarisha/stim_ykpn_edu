<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicActivity extends Model
{
    use HasFactory;

    protected $table = 'academic_activities';

    protected $fillable = [
        'title',
        'content',
        'header_image',
    ];
}
