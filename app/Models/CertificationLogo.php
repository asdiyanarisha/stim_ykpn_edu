<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationLogo extends Model
{
    use HasFactory;

    protected $table = 'certification_logos';

    protected $fillable = [
        'title',
        'description',
        'url_image',
        'views_count',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'views_count' => 'integer',
    ];

    /**
     * Get the user who created the certification logo.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
