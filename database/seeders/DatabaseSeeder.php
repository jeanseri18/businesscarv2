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
        // Appeler les seeders dans l'ordre approprié
        $this->call([
            AdminSeeder::class,
            EntrepriseSeeder::class,
            SouscriptionSeeder::class,
            PaiementSeeder::class,
            AchatSeeder::class,
        ]);

        // Créer un utilisateur de test supplémentaire (commercial par défaut)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+221700000001',
            'country' => 'Sénégal',
            'nationality' => 'Sénégalaise',
            'accept_terms' => true,
            'role' => 'commercial',
        ]);
    }
}
