<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();

        return inertia('Invoices/Index', [
            'invoices' => InvoiceResource::collection($invoices),
        ]);
    }

    public function store(Request $request)
    {
        $invoice = Invoice::create([
            ...$request->validate([
                'from_address' => ['required', 'string', 'max:100'],
            ]),
            'status' => InvoiceStatus::PENDING,
        ]);

        return to_route('invoices.show', $invoice);
    }

    public function show(Invoice $invoice)
    {
        return inertia('Invoices/Show', [
            'invoice' => new InvoiceResource($invoice),
        ]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update(
            $request->validate([
                'from_address' => ['required', 'string', 'max:100'],
            ])
        );

        return back();
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return to_route('invoices');
    }
}
