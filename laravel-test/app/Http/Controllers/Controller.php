<?php

namespace App\Http\Controllers;

use App\Services\PaymentLogger;

abstract class Controller
{
    public function __construct(
        protected PaymentLogger $logger
    ) {}
}
