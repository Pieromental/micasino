<?php

namespace App\Processors;

use App\Clients\EasyMoneyClient;
use App\Interfaces\PaymentProcessorInterface;
use App\Models\Transaction;
use App\Services\PaymentLogger;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\JsonResponse;

class EasyMoneyProcessor implements PaymentProcessorInterface
{
    protected $logger;
    protected $gateway;
    protected $client;
    protected $transactionService;
    public function __construct(PaymentLogger $logger, TransactionService $transactionService)
    {
        $this->logger = $logger;
        $this->client = app(config('services.easymoney.client_class'));
        $this->gateway = config('services.easymoney.gateway');
        $this->transactionService = $transactionService;
    }

    public function processPayment(array $data): JsonResponse
    {
        try {

            $this->logger->logRequest($this->gateway, $data);

            $response = $this->client->sendPayment($data);

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
