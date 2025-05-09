<?php

namespace App\Clients;

use App\Interfaces\PaymentClientInterface;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class EasyMoneyClient  implements PaymentClientInterface 

{
    protected string $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.easymoney.base_uri');
    }

    public function sendPayment(array $data): array
    {
        try {
            $response = Http::post($this->baseUri, [
                'amount' => $data['amount'],
                'currency' => $data['currency'],
            ]);

            if ($response->successful()) {
                $body = $response->body();

                return [
                    'success' => $body === 'ok',
                    'gateway_response' => $body
                ];
            }

            throw new \Exception('Error en EasyMoney: ' . $response->body());
        } catch (RequestException $e) {
            throw new \Exception('Fallo de conexión con EasyMoney: ' . $e->getMessage());
        }
    }
}