<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public function create(string $gateway, array $data, array $response): Transaction
    {
        return Transaction::create([
            'gateway' => $gateway,
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'status' => 'pending',
            'gateway_transaction_id' => $response['transaction_id'] ?? null,
            'gateway_response' => json_encode($response)
        ]);
    }

    public function updateStatus(Transaction $transaction, string $status): Transaction
    {
        $transaction->update(['status' => $status]);
        return $transaction;
    }
}