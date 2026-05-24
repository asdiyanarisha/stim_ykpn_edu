<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicGoalAchieve extends Model
{
    use HasFactory;

    protected $table = 'academic_goal_achieve';

    protected $fillable = [
        'title',
        'content',
        'header_image',
    ];
}
