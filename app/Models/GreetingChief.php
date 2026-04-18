<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreetingChief extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'header_image',
    ];
}
