<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calendrier>
 */
class CalendrierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tontine_id' => null, // à lier dans le seeder
            'date_cotisation' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'montant' => fake()->randomElement([5000, 10000, 20000, 50000]),
        ];
    }
}
