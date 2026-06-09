<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'slug',
        'spa_fee',
        'spa_fee_fixed',
        'spa_fee_variable',
        'tagline',
        'description',
        'image_banner',
        'study_duration',
        'degree_title',
        'total_sks',
        'accreditation',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'total_sks' => 'integer',
        'spa_fee' => 'integer',
        'spa_fee_fixed' => 'integer',
        'spa_fee_variable' => 'integer',
    ];

    public function concentrations()
    {
        return $this->hasMany(ProgramStudyConcentration::class)->orderBy('order');
    }

    public function careers()
    {
        return $this->hasMany(ProgramStudyCareer::class)->orderBy('order');
    }
}
