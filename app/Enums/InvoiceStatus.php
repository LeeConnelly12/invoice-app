<?php

namespace App\Enums;

enum InvoiceStatus: int
{
    case DRAFT = 0;
    case PENDING = 1;
    case COMPLETED = 2;

    public function name(): string
    {
        return match($this)
        {
           InvoiceStatus::DRAFT => 'draft',
           InvoiceStatus::PENDING => 'pending',
           InvoiceStatus::COMPLETED => 'completed',
        };
    }
}