<?php

namespace App\Clients;

use App\Interfaces\PaymentClientInterface;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class SuperWalletClient implements PaymentClientInterface 

{
    protected string $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.superwalletz.base_uri');
    }

    public function sendPayment(array $data): array
    {
        try {
     
            $response = Http::post($this->baseUri, $data);
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception("Error al comunicar con EasyMoney: " . $e->getMessage());
        }
    }
}
