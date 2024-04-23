<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;

class MarkInvoiceAsPaidController extends Controller
{
    public function __invoke(Invoice $invoice)
    {
        $invoice->update([
            'status' => InvoiceStatus::PAID,
        ]);

        return back();
    }
}
