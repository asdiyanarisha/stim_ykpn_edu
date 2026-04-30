<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbProgramExtensi extends Model
{
    use HasFactory;
    protected $table = 'pmb_program_extensi';
    protected $fillable = ['title', 'content', 'header_image'];
}
