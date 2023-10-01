<?php

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can view invoices', function () {
    Invoice::factory()->for($this->user)->count(3)->create();

    get('/')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Invoices/Index')
            ->has('invoices', 3)
        );
});

it('can create invoices', function () {
    post('/invoices', [
        'invoice' => [
            'status' => InvoiceStatus::PENDING->value,
            'address' => '19 Union Terrace',
            'city' => 'London',
            'postcode' => 'E1 3EZ',
            'country' => 'United Kingdom',
            'client_name' => 'John',
            'client_email' => 'johndoe@test.com',
            'client_address' => '19 Union Terrace',
            'client_city' => 'London',
            'client_postcode' => 'E1 3EZ',
            'client_country' => 'United Kingdom',
        ],
        'items' => [],
    ])->assertRedirect();

    assertDatabaseHas(Invoice::class, [
        'status' => InvoiceStatus::PENDING->value,
        'address' => '19 Union Terrace',
        'city' => 'London',
        'postcode' => 'E1 3EZ',
        'country' => 'United Kingdom',
        'client_name' => 'John',
        'client_email' => 'johndoe@test.com',
        'client_address' => '19 Union Terrace',
        'client_city' => 'London',
        'client_postcode' => 'E1 3EZ',
        'client_country' => 'United Kingdom',
    ]);
});

it('can create draft invoices', function () {
    post('/invoices', [
        'invoice' => [
            'status' => InvoiceStatus::DRAFT->value,
        ],
    ])->assertRedirect();

    assertDatabaseHas(Invoice::class, [
        'status' => InvoiceStatus::DRAFT->value,
    ]);
});

it('generates an ID when creating an invoice', function () {
    $invoice = Invoice::factory()->create();

    expect($invoice->invoice_id)
        ->toBeString()
        ->toHaveLength(5);
});

it('can add items to invoice', function () {
    post('/invoices', [
        'invoice' => [
            'status' => InvoiceStatus::DRAFT->value,
            ...Invoice::factory()->raw(),
        ],
        'items' => [
            [
                'name' => 'Banner Design',
                'quantity' => 1,
                'price' => 15600,
            ],
            [
                'name' => 'Email Design',
                'quantity' => 2,
                'price' => 20000,
            ],
        ],
    ])->assertRedirect();

    assertDatabaseHas(InvoiceItem::class, [
        'name' => 'Banner Design',
        'quantity' => 1,
        'price' => 156,
        'total' => 156,
    ]);

    assertDatabaseHas(InvoiceItem::class, [
        'name' => 'Email Design',
        'quantity' => 2,
        'price' => 200,
        'total' => 400,
    ]);
});

it('can update invoices', function () {
    $invoice = Invoice::factory()->for($this->user)->create([
        'client_name' => 'John',
    ]);

    put('/invoices/'.$invoice->id, [
        'invoice' => [
            ...$invoice->getRawOriginal(),
            'status' => InvoiceStatus::PENDING->value,
            'client_name' => 'Jane',
        ],
    ])->assertRedirect();

    assertDatabaseHas(Invoice::class, [
        'client_name' => 'Jane',
    ]);
});

it('can update invoice items', function () {
    $invoice = Invoice::factory()->for($this->user)->create();

    InvoiceItem::factory()->for($invoice)->create([
        'name' => 'Email design',
        'quantity' => 2,
        'price' => 20000,
    ]);

    put('/invoices/'.$invoice->id, [
        'invoice' => [
            ...$invoice->getRawOriginal(),
            'status' => InvoiceStatus::PENDING->value,
        ],
        'items' => [
            [
                'name' => 'Banner Design',
                'quantity' => 1,
                'price' => 15600,
            ],
        ],
    ])->assertRedirect();

    assertDatabaseHas(InvoiceItem::class, [
        'name' => 'Banner Design',
        'quantity' => 1,
        'price' => 156,
        'total' => 156,
    ]);
});

it('cannot update other user invoices', function () {
    $invoice = Invoice::factory()->create();

    put('/invoices/'.$invoice->id, [
        'client_name' => 'Jane',
    ])->assertForbidden();
});

it('can delete invoices', function () {
    $invoice = Invoice::factory()->for($this->user)->create();

    delete('/invoices/'.$invoice->id)
        ->assertRedirect();

    assertDatabaseMissing(Invoice::class, [
        'id' => $invoice->id,
    ]);
});

it('cannot delete other user invoices', function () {
    $invoice = Invoice::factory()->create();

    delete('/invoices/'.$invoice->id, [
        'client_name' => 'Jane',
    ])->assertForbidden();
});
