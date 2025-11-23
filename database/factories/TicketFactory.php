<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::query()->inRandomOrder()->first()->id,
            'subject' => $this->faker->sentence(),
            'text' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(StatusEnum::class),
            'manager_reply_at' => fake()->optional()->dateTime(),
        ];
    }
}
