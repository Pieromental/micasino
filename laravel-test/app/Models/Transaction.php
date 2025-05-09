<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'gateway',
        'amount',
        'currency',
        'status',
        'gateway_transaction_id',
        'gateway_response'
    ];
}
