<?php

use App\Models\Invoice;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\put;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    /** @var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can be created', function () {
    post('/invoices', [
        'client_name' => 'john',
        'client_email' => 'john@example.com',
        'description' => 'new invoice',
        'payment_terms' => 30,
    ])
    ->assertRedirect('/invoices/1');

    assertDatabaseCount(Invoice::class, 1);
});

it('can be updated', function () {
    $invoice = Invoice::factory()
        ->for($this->user)
        ->create([
            'client_name' => 'john',
            'client_email' => 'john@example.com',
            'description' => 'new invoice',
            'payment_terms' => 30,
        ]);

    put('/invoices/'.$invoice->id, [
        'client_name' => 'jane',
        'client_email' => 'jane@example.com',
        'description' => 'updated invoice',
        'payment_terms' => 20,
    ])
    ->assertRedirect('/invoices/1');

    $invoice->refresh();

    expect($invoice->client_name)->toBe('jane');
    expect($invoice->client_email)->toBe('jane@example.com');
    expect($invoice->description)->toBe('updated invoice');
    expect($invoice->payment_terms)->toBe(20);
});