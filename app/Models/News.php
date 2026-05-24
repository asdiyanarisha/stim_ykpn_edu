<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'content',
        'url_image',
        'views_count',
        'status',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'views_count' => 'integer',
    ];

    /**
     * Get the user who created the news.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
