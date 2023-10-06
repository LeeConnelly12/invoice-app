<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'status' => $this->status,
            'address' => $this->address,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'country' => $this->country,
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_address' => $this->client_address,
            'client_city' => $this->client_city,
            'client_postcode' => $this->client_postcode,
            'client_country' => $this->client_country,
            'invoice_date' => $this->invoice_date?->toDateString(),
            'items' => InvoiceItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
