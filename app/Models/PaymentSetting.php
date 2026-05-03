<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'register_fee',
        'pkkmb_fee',
        'affiliate_point_per_register',
        'minimal_withdraw_affiliate',
    ];
}
