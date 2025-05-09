<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'gateway',
        'payload',
        'ip_address'
    ];
}
