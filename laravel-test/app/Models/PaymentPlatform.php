<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlatform extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'accepts_decimals'
    ];
}
