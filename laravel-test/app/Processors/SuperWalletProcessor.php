<?php

namespace App\Processors;

use App\Clients\SuperWalletClient;
use App\Interfaces\PaymentProcessorInterface;
use App\Services\PaymentLogger;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\JsonResponse;

class SuperWalletProcessor implements PaymentProcessorInterface
{
    protected $logger;
    protected $gateway;
    protected $client;
    protected $transactionService;
    public function __construct(PaymentLogger $logger, TransactionService $transactionService)
    {
        $this->logger = $logger;
        $this->client = app(config('services.superwalletz.client_class'));
        $this->gateway = config('services.superwalletz.gateway');
        $this->transactionService = $transactionService;
    }

    public function processPayment(array $data): JsonResponse
    {
        try {
        
            $this->logger->logRequest($this->gateway, $data);

            $requestData = [
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'callback_url' => config('services.superwalletz.callback_uri'),
                'description' => $this->gateway
            ];

            $response = $this->client->sendPayment($requestData);

            $transaction = $this->transactionService->create($this->gateway, $data, $response);

            return response()->json([
                'success' => true,
                'transaction_id' => $transaction->id,
                'gateway_response' => $response
            ]);
        } catch (Exception $e) {
            $this->logger->logError($this->gateway, $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
