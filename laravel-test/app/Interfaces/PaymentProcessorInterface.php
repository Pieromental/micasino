<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface PaymentProcessorInterface
{
    public function processPayment(array $data): JsonResponse;
}

