<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Jobs\ProcessWebhookJob;
use App\Resolvers\PaymentPlatformResolver;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    public function process(PaymentRequest $request, PaymentPlatformResolver $paymentPlatformResolver)
    {
        try {

            $validated = $request->validated();
            $paymentProcessor = $paymentPlatformResolver
                ->resolveService($request->payment_platform_id);

            return $paymentProcessor->processPayment($validated);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function handle(Request $request)
    {
        try {

            ProcessWebhookJob::dispatch('weebhook', $request->all());

            return response()->json(['message' => 'Webhook recibido correctamente.'], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
