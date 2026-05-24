<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LodgingInformation extends Model
{
    use HasFactory;

    protected $table = 'lodging_information';

    protected $fillable = [
        'title',
        'content',
        'header_image',
    ];
}
