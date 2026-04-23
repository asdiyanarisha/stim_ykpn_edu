<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelPeriodStudy extends Model
{
    use HasFactory;

    protected $table = 'level_period_study';

    protected $fillable = [
        'title',
        'content',
        'header_image',
    ];
}
