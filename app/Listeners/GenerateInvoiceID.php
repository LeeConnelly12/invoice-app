<?php

namespace App\Listeners;

use App\Models\Invoice;
use Illuminate\Support\Str;
use App\Events\InvoiceCreating;

class GenerateInvoiceID
{
    /**
     * Handle the event.
     */
    public function handle(InvoiceCreating $event): void
    {
        $id = Str::upper(2) . rand(1000, 9999);

        if (Invoice::query()->where('invoice_id', $id)->exists()) {
            $this->handle($event);
            return;
        }

        $event->invoice->invoice_id = $id;
    }
}
