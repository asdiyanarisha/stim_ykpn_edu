<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationTeacher extends Model
{
    use HasFactory;

    protected $table = 'education_teachers';

    protected $fillable = [
        'teacher_id',
        'degree',
        'major',
        'institution',
        'graduation_year',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
