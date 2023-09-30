<?php

namespace App\Enums;

enum InvoiceStatus: int
{
    case DRAFT = 0;
    case PENDING = 1;
    case PAID = 2;
}
