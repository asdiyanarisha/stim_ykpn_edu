<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTeacher extends Model
{
    use HasFactory;

    protected $table = 'books_teachers';

    protected $fillable = [
        'teacher_id',
        'title',
        'publisher',
        'year',
        'isbn',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
