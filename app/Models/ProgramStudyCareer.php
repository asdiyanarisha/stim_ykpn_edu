<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudyCareer extends Model
{
    use HasFactory;

    protected $table = 'program_study_careers';

    protected $fillable = [
        'program_study_id',
        'title',
        'description',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function programStudy()
    {
        return $this->belongsTo(ProgramStudy::class);
    }
}
