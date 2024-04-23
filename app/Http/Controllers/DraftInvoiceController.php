<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DraftInvoiceController extends Controller
{
    public function store(Request $request)
    {
        Invoice::create([
            ...$request->validate([
                'from_address' => ['nullable', 'string', 'max:100'],
            ]),
            'status' => InvoiceStatus::DRAFT,
        ]);

        return back();
    }
}
