<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cotisation>
 */
class CotisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'membre_id' => null, // à lier dans le seeder
            'montant' => fake()->randomElement([5000, 10000, 20000, 50000]),
            'date_paiement' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'statut' => fake()->randomElement(['paye', 'impaye']),
            'penalite' => fake()->randomElement([0, 500, 1000, 2000]),
        ];
    }
}
