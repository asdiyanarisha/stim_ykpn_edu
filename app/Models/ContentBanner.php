<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentBanner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'content_banner';

    protected $fillable = [
        'title',
        'description',
        'button_text',
        'link',
        'url_image',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
