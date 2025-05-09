<?php

namespace App\Services;

use App\Models\PaymentRequestLog;
use App\Models\WebhookLog;

class PaymentLogger
{
    public function logRequest(string $gateway,array $requestData): void
    {
        PaymentRequestLog::create([
            'gateway' => $gateway  ,
            'request_data' => json_encode($requestData),
            'ip_address' => request()->ip()
        ]);
    }
    public function logError(string $gateway, string $errorMessage): void
    {
        PaymentRequestLog::create([
            'gateway' => $gateway,
            'error_message' => $errorMessage,
            'ip_address' => request()->ip()
        ]);
    }
    public function logWebhook(string $gateway, array $data): void
    {
        WebhookLog::create([
            'gateway' => $gateway,
            'payload' => json_encode($data),
            'ip_address' => request()->ip()
        ]);
    }
}
