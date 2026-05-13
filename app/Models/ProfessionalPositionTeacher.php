<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalPositionTeacher extends Model
{
    use HasFactory;

    protected $table = 'professional_positions_teachers';

    protected $fillable = [
        'teacher_id',
        'position',
        'institution',
        'start_year',
        'end_year',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
