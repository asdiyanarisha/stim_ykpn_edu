<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicGoal extends Model
{
    use HasFactory;

    protected $table = 'academic_goals';

    protected $fillable = [
        'title',
        'content',
        'header_image',
    ];
}
