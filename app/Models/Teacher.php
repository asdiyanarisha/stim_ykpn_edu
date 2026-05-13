<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_teacher_id',
        'job_title_teacher_id',
        'full_name',
        'front_title',
        'back_title',
        'birth_date',
        'email',
        'phone_number',
        'address',
        'personal_description',
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryTeacher::class, 'category_teacher_id');
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class, 'job_title_teacher_id');
    }

    public function education()
    {
        return $this->hasMany(EducationTeacher::class, 'teacher_id');
    }

    public function professional_positions()
    {
        return $this->hasMany(ProfessionalPositionTeacher::class, 'teacher_id');
    }

    public function research_areas()
    {
        return $this->hasMany(ResearchAreaTeacher::class, 'teacher_id');
    }

    public function publications()
    {
        return $this->hasMany(PublicationTeacher::class, 'teacher_id');
    }

    public function books()
    {
        return $this->hasMany(BookTeacher::class, 'teacher_id');
    }

    public function popular_writings()
    {
        return $this->hasMany(PopularWritingTeacher::class, 'teacher_id');
    }

    public function awards()
    {
        return $this->hasMany(AwardTeacher::class, 'teacher_id');
    }

    public function online_academic_profiles()
    {
        return $this->hasMany(OnlineAcademicProfileTeacher::class, 'teacher_id');
    }
}
