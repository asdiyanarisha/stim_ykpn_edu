<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchAreaTeacher extends Model
{
    use HasFactory;

    protected $table = 'research_areas_teachers';

    protected $fillable = [
        'teacher_id',
        'area_name',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
