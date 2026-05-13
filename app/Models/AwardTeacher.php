<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardTeacher extends Model
{
    use HasFactory;

    protected $table = 'awards_teachers';

    protected $fillable = [
        'teacher_id',
        'award_name',
        'grantor',
        'year',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
