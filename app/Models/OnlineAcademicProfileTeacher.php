<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineAcademicProfileTeacher extends Model
{
    use HasFactory;

    protected $table = 'online_academic_profiles_teachers';

    protected $fillable = [
        'teacher_id',
        'platform_name',
        'url',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
