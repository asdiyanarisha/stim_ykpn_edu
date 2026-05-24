<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type_article',
        'author',
        'file_path',
        'year',
    ];
}
