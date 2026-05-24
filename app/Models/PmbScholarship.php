<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbScholarship extends Model
{
    use HasFactory;
    protected $table = 'pmb_scholarship';
    protected $fillable = ['title', 'content', 'header_image'];
}
