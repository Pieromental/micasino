<?php

namespace App\Http\Requests;

use App\Models\PaymentPlatform;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_platform_id' => 'required|numeric|exists:payment_platforms,id',
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string|size:3',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $platformId = $this->input('payment_platform_id');
            $amount = $this->input('amount');

            $platform = PaymentPlatform::find($platformId);

            if ($platform && !$platform->accepts_decimals && fmod($amount, 1) !== 0.0) {
                $validator->errors()->add('amount', "{$platform->name} no acepta montos con decimales.");
            }
        });
    }
}
