<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory, HasUuids;

    protected $dispatchesEvents = [
        'creating' => \App\Events\InvoiceCreating::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
