<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularWritingTeacher extends Model
{
    use HasFactory;

    protected $table = 'popular_writings_teachers';

    protected $fillable = [
        'teacher_id',
        'title',
        'media',
        'date',
        'url',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
