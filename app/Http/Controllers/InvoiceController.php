<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the user's invoices.
     */
    public function index(Request $request)
    {
        $invoices = $request->User()->invoices()->get();

        return inertia('Invoices/Index', [
            'invoices' => $invoices,
        ]);
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => ['required', new Enum(InvoiceStatus::class)],
            'address' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:50',
            ],
            'city' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'postcode' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'country' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'client_name' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'client_email' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:50',
            ],
            'client_address' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:50',
            ],
            'client_city' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'client_postcode' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'client_country' => [
                'required_unless:status,0',
                'nullable',
                'string',
                'max:25',
            ],
            'items' => ['array'],
            'items.*.name' => ['string', 'max:25'],
            'items.*.quantity' => ['numeric', 'integer', 'min:1', 'max:255'],
            'items.*.price' => ['numeric', 'integer', 'min:0', 'max:100000'],
        ]);

        $invoice = $request->user()->invoices()->create(
            $request->only([
                'status',
                'address',
                'city',
                'postcode',
                'country',
                'client_name',
                'client_email',
                'client_address',
                'client_city',
                'client_postcode',
                'client_country',
            ])
        );

        $invoice->items()->createMany($request->items);

        return back();
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'client_name' => ['required', 'string', 'max:25'],
        ]);

        $invoice->update([
            'client_name' => $request->client_name,
        ]);

        return back();
    }

    /**
     * Remove the specified invoice from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return back();
    }
}
