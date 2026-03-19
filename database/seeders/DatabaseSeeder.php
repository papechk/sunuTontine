<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création d'un admin
        $admin = \App\Models\User::factory()->create([
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@sunutontine.com',
            'role' => 'admin',
        ]);

        // Création de 3 gestionnaires
        $gestionnaires = \App\Models\User::factory(3)->create([
            'role' => 'gestionnaire',
        ]);

        // Pour chaque gestionnaire, créer 2 tontines
        foreach ($gestionnaires as $gestionnaire) {
            $tontines = \App\Models\Tontine::factory(2)->create([
                'gestionnaire_id' => $gestionnaire->id,
            ]);

            // Pour chaque tontine, créer 5 membres (participants)
            foreach ($tontines as $tontine) {
                $participants = \App\Models\User::factory(5)->create([
                    'role' => 'participant',
                    'gestionnaire_id' => $gestionnaire->id,
                ]);
                foreach ($participants as $participant) {
                    $membre = \App\Models\Membre::factory()->create([
                        'user_id' => $participant->id,
                        'tontine_id' => $tontine->id,
                        'statut' => 'valide',
                    ]);
                    // Cotisations pour chaque membre
                    \App\Models\Cotisation::factory(3)->create([
                        'membre_id' => $membre->id,
                    ]);
                }
                // Générer des dates de calendrier pour la tontine
                \App\Models\Calendrier::factory(6)->create([
                    'tontine_id' => $tontine->id,
                ]);
            }
        }
    }
}
