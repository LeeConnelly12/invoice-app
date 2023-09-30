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
            'client_name' => [
                Rule::requiredIf($request->status !== InvoiceStatus::DRAFT->value),
                'nullable',
                'string',
                'max:25',
            ],
        ]);

        $request->user()->invoices()->create([
            'status' => $request->status,
            'client_name' => $request->client_name,
        ]);

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
