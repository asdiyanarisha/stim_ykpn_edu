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

    public function education()
    {
        return $this->hasMany(EducationTeacher::class, 'teacher_id');
    }
}
