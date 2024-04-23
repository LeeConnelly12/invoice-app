<?php

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelMissing;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('invoices page can be viewed', function () {
    Invoice::factory()->count(3)->create();

    actingAs($this->user)
        ->get('/')
        ->assertInertia(fn (Assert $page) => $page
            ->component('Invoices/Index')
            ->has('invoices', 3)
        );
});

test('an invoice can be viewed', function () {
    $invoice = Invoice::factory()->create();

    actingAs($this->user)
        ->get('/invoices/'.$invoice->id)
        ->assertInertia(fn (Assert $page) => $page
            ->component('Invoices/Show')
            ->has('invoice', fn (Assert $page) => $page
                ->whereAll([
                    'id' => $invoice->id,
                ])
                ->etc()
            )
        );
});

test('an invoice can be created', function () {
    actingAs($this->user)
        ->post('/invoices', [
            'from_address' => 'London',
        ])
        ->assertRedirect();

    assertDatabaseHas(Invoice::class, [
        'from_address' => 'London',
        'status' => InvoiceStatus::PENDING,
    ]);
});

test('an invoice can be created as draft', function () {
    actingAs($this->user)
        ->post('/draft-invoices', [
            'from_address' => null,
        ])
        ->assertRedirect();

    assertDatabaseHas(Invoice::class, [
        'status' => InvoiceStatus::DRAFT,
    ]);
});

test('an invoice can be marked as paid', function () {
    $invoice = Invoice::factory()->pending()->create();

    actingAs($this->user)
        ->put('/invoices/'.$invoice->id.'/mark-as-paid')
        ->assertRedirect();

    $invoice->refresh();

    expect($invoice->status)->toBe(InvoiceStatus::PAID);
});

test('an invoice can be updated', function () {
    $invoice = Invoice::factory()->create([
        'from_address' => 'London',
    ]);

    actingAs($this->user)
        ->put('/invoices/'.$invoice->id, [
            'from_address' => 'Canada',
        ])
        ->assertRedirect();

    $invoice->refresh();

    expect($invoice->from_address)->toBe('Canada');
});

test('an invoice can be deleted', function () {
    $invoice = Invoice::factory()->create();

    actingAs($this->user)
        ->delete('/invoices/'.$invoice->id)
        ->assertRedirect('/');

    assertModelMissing($invoice);
});
