<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the user's invoices.
     */
    public function index(Request $request)
    {
        $invoices = $request->User()->invoices()->get();

        return inertia('Invoices', [
            'invoices' => $invoices,
        ]);
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = $request->user()
            ->invoices()
            ->create($request->validated('invoice'));

        $invoice->items()->createMany($request->validated('items', []));

        return back();
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated('invoice'));

        $invoice->items()->delete();

        $invoice->items()->createMany($request->validated('items', []));

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
