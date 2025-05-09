<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Services\PaymentLogger;
use App\Services\TransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected string $gateway,
        protected array $data
    ) {}

    public function handle(PaymentLogger $logger,TransactionService $transactionService): void
    {
        try {
            $logger->logWebhook($this->gateway, $this->data);
            if (isset($this->data['transaction_id'])) {

                $transaction = Transaction::where('gateway_transaction_id', $this->data['transaction_id'])->first();
                if ($transaction) {
                    $transactionService->updateStatus($transaction, $this->data['status'] ?? 'unknown');
                }
            }
        } catch (Throwable $e) {
            $logger->logError($this->gateway, $e->getMessage());
            $this->fail($e); 
        }
    }
}
