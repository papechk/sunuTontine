<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membre>
 */
class MembreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, // à lier dans le seeder
            'tontine_id' => null, // à lier dans le seeder
            'statut' => fake()->randomElement(['en_attente', 'valide', 'refuse']),
            'date_adhesion' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
