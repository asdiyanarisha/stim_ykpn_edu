<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationTeacher extends Model
{
    use HasFactory;

    protected $table = 'publications_teachers';

    protected $fillable = [
        'teacher_id',
        'title',
        'journal_name',
        'year',
        'url',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
