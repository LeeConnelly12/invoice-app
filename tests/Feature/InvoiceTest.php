<?php

use App\Models\User;
use App\Models\Invoice;
use App\Enums\InvoiceStatus;
use Inertia\Testing\AssertableInertia as Assert;
use function Pest\Laravel\{actingAs, assertDatabaseHas, assertDatabaseMissing, get, post, put, delete};

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can view invoices', function () {
    Invoice::factory()->for($this->user)->count(3)->create();

    get('/invoices')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Invoices/Index')
            ->has('invoices', 3)
        );
});

it('can create invoices', function () {
    post('/invoices', [
        'client_name' => 'John',
    ])->assertRedirect();

    assertDatabaseHas(Invoice::class, [
        'client_name' => 'John',
    ]);
});

it('can create draft invoices', function () {
    post('/invoices', [
        'client_name' => null,
        'status' => InvoiceStatus::DRAFT->value,
    ]);

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

it('can update invoices', function () {
    $invoice = Invoice::factory()->for($this->user)->create([
        'client_name' => 'John',
    ]);

    put('/invoices/' . $invoice->id, [
        'client_name' => 'Jane',
    ])->assertRedirect();

    assertDatabaseHas(Invoice::class, [
        'client_name' => 'Jane',
    ]);
});

it('cannot update other user invoices', function () {
    $invoice = Invoice::factory()->create();

    put('/invoices/' . $invoice->id, [
        'client_name' => 'Jane',
    ])->assertForbidden();
});

it('can delete invoices', function () {
    $invoice = Invoice::factory()->for($this->user)->create();

    delete('/invoices/' . $invoice->id)
        ->assertRedirect();

    assertDatabaseMissing(Invoice::class, [
        'id' => $invoice->id,
    ]);
});

it('cannot delete other user invoices', function () {
    $invoice = Invoice::factory()->create();

    delete('/invoices/' . $invoice->id, [
        'client_name' => 'Jane',
    ])->assertForbidden();
});
