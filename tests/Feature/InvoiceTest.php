<?php

use App\Models\Invoice;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\put;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

beforeEach(function () {
    /** @var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can all be viewed', function () {
    $invoices = Invoice::factory()
        ->for($this->user)
        ->count(3)
        ->create();

    get('/invoices')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Invoices/Index')
            ->has('invoices', 3, fn (Assert $page) => $page
                ->where('id', $invoices->first()->id)
                ->where('client_name', $invoices->first()->client_name)
                ->where('client_email', $invoices->first()->client_email)
                ->where('description', $invoices->first()->description)
                ->etc()
            )
        );
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
    ->assertRedirect('/invoices/'.$invoice->id);

    $invoice->refresh();

    expect($invoice->client_name)->toBe('jane');
    expect($invoice->client_email)->toBe('jane@example.com');
    expect($invoice->description)->toBe('updated invoice');
    expect($invoice->payment_terms)->toBe(20);
});