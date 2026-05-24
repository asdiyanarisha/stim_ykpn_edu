<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $table = 'job_vacancies';

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
     * Get the user who created the job vacancy.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
