<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbStatus extends Model
{
    use HasFactory;

    protected $table = 'pmb_status';

    protected $fillable = [
        'status',
        'slug',
    ];

    public function pmbs()
    {
        return $this->hasMany(Pmb::class, 'pmb_status_id');
    }
}
