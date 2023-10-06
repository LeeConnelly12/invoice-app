<?php

namespace App\Http\Requests;

use App\Enums\InvoiceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class InvoiceRequest extends FormRequest
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
            'invoice.status' => ['required', new Enum(InvoiceStatus::class)],
            'invoice.address' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:50',
            ],
            'invoice.city' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'invoice.postcode' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'invoice.country' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'invoice.client_name' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'invoice.client_email' => [
                'required_unless:invoice.status,0',
                'nullable',
                'email',
                'max:50',
            ],
            'invoice.client_address' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:50',
            ],
            'invoice.client_city' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'invoice.client_postcode' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'invoice.client_country' => [
                'required_unless:invoice.status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'invoice.invoice_date' => [
                'required_unless:invoice.status,0',
                'nullable',
                'date',
            ],
            'invoice.items' => ['array'],
            'invoice.items.*.name' => ['string', 'max:25'],
            'invoice.items.*.quantity' => [
                'numeric',
                'integer',
                'min:1',
                'max:255',
            ],
            'invoice.items.*.price' => [
                'numeric',
                'integer',
                'min:0',
                'max:100000',
            ],
        ];
    }
}
