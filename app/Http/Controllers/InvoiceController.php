<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('Invoices/Index', [
            'invoices' => $request->user()
                ->invoices()
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $invoice = $request->user()->invoices()->create([
            ...$request->validate([
                'client_name' => ['required', 'string', 'max:25'],
                'client_email' => ['required', 'string', 'email', 'max:50'],
                'description' => ['required', 'string', 'max:50'],
                'payment_terms' => ['required', 'integer', 'min:1', 'max:30'],
            ]),
            'status' => InvoiceStatus::PENDING
        ]);

        return to_route('invoices.show', $invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update(
            $request->validate([
                'client_name' => ['required', 'string', 'max:25'],
                'client_email' => ['required', 'string', 'email', 'max:50'],
                'description' => ['required', 'string', 'max:50'],
                'payment_terms' => ['required', 'integer', 'min:1', 'max:30'],
            ])
        );

        return to_route('invoices.show', $invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return to_route('invoices');
    }
}
