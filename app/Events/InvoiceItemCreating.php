<?php

namespace App\Events;

use App\Models\InvoiceItem;
use Illuminate\Queue\SerializesModels;

class InvoiceItemCreating
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public InvoiceItem $invoiceItem
    ) {
    }
}
