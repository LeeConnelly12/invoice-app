<?php

namespace Database\Factories;

use App\Enums\InvoiceStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => fake()->randomElement(InvoiceStatus::class),
            'address' => fake()->text(50),
            'city' => fake()->city(),
            'postcode' => fake()->postcode(),
            'country' => fake()->text(25),
            'client_name' => fake()->text(25),
            'client_email' => fake()->email(),
            'client_address' => fake()->text(50),
            'client_city' => fake()->city(),
            'client_postcode' => fake()->postcode(),
            'client_country' => fake()->text(25),
            'invoice_date' => fake()->date(),
        ];
    }
}
