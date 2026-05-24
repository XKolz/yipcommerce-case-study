<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'delivery_address' => ['required', 'string', 'max:1000'],
            'city' => ['required', 'string', 'max:120'],
            'payment_method' => ['required', Rule::in(['Cash on Delivery', 'Bank Transfer'])],
        ];
    }
}
