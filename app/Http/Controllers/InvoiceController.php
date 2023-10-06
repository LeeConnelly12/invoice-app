<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the user's invoices.
     */
    public function index(Request $request)
    {
        $invoices = $request->user()->invoices()
            ->with('items')
            ->filter($request->only('status'))
            ->get();

        return inertia('Invoices', [
            'invoices' => InvoiceResource::collection($invoices),
        ]);
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = $request->user()
            ->invoices()
            ->create(
                Arr::except($request->validated('invoice'), 'items')
            );

        $invoice->items()->createMany($request->validated('invoice.items', []));

        return back();
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update(
            Arr::except($request->validated('invoice'), 'items')
        );

        $invoice->items()->delete();

        $invoice->items()->createMany($request->validated('invoice.items', []));

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
