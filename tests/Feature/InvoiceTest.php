<?php

use App\Models\Invoice;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\assertDatabaseCount;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);
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