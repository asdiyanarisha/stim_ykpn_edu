<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonyAlumni extends Model
{
    use HasFactory;

    protected $table = 'testimony_alumni';

    protected $fillable = [
        'name',
        'testimony',
        'image',
    ];
}
