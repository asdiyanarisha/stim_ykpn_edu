<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicFile extends Model
{
    use HasFactory;

    protected $table = 'public_files';

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_size',
    ];
}
