<?php

namespace App\Interfaces;

interface PaymentClientInterface
{
    public function sendPayment(array $data): array;
}

