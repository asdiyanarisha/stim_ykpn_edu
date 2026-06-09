<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudyConcentration extends Model
{
    use HasFactory;

    protected $table = 'program_study_concentrations';

    protected $fillable = [
        'program_study_id',
        'name',
        'description',
        'icon',
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
