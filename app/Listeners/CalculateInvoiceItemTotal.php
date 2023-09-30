<?php

namespace App\Listeners;

use App\Events\InvoiceItemCreating;

class CalculateInvoiceItemTotal
{
    /**
     * Handle the event.
     */
    public function handle(InvoiceItemCreating $event): void
    {
        $event->invoiceItem->total = $event->invoiceItem->price * $event->invoiceItem->quantity;
    }
}
