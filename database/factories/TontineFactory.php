<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tontine>
 */
class TontineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->words(2, true),
            'montant_cotisation' => fake()->randomElement([5000, 10000, 20000, 50000]),
            'frequence' => fake()->randomElement(['mensuel', 'hebdo']),
            'date_debut' => fake()->dateTimeBetween('-1 year', '+1 month'),
            'gestionnaire_id' => null, // à lier dans le seeder
            'statut' => 'actif',
        ];
    }
}
