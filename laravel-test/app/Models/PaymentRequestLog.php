<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequestLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'gateway',
        'request_data',
        'error_message',
        'ip_address'
    ];
}
