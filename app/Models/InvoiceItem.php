<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory, HasUuids;

    protected $dispatchesEvents = [
        'creating' => \App\Events\InvoiceItemCreating::class,
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn (int $value) => $value / 100,
        );
    }
}
