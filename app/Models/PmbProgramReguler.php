<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbProgramReguler extends Model
{
    use HasFactory;
    protected $table = 'pmb_program_reguler';
    protected $fillable = ['title', 'content', 'header_image'];
}
