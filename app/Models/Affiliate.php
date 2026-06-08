<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'institution',
        'position',
        'city',
        'address',
        'bank_name',
        'account_holder_name',
        'account_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
