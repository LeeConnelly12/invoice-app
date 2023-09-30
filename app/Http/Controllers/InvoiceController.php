<?php

namespace App\Http\Controllers;

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
            'client_name' => ['required', 'string', 'max:25'],
        ]);

        $request->user()->invoices()->create([
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
