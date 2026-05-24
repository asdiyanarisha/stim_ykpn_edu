<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'spa_fee',
        'spa_fee_fixed',
        'spa_fee_variable',
    ];
}
