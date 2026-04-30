<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusLiveVideo extends Model
{
    use HasFactory;

    protected $table = 'campus_live_video';

    protected $fillable = [
        'title',
        'description',
        'link',
    ];
}
