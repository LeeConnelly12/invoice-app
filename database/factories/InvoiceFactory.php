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
    public function definition()
    {
        return [
            'user_id' => ($this->user ?? User::factory()->create()->id),
            'client_name' => fake()->name(),
            'client_email' => fake()->email(),
            'description' => fake()->text(50),
            'payment_terms' => fake()->numberBetween(1, 30),
            'status' => fake()->randomElement(InvoiceStatus::cases())
        ];
    }
}
