<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\OffreEtService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer plusieurs entreprises avec des offres et services
        $entreprises = [
            [
                'name' => 'Entreprise Technologie Sénégal',
                'email' => 'tech@entreprise.sn',
                'phone' => '+221701234567',
                'country' => 'Sénégal',
                'nationality' => 'Sénégalaise',
                'accept_terms' => true,
                'role' => 'entreprise',
                'password' => Hash::make('entreprise123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Société de Services Alpha',
                'email' => 'alpha@services.com',
                'phone' => '+221781234568',
                'country' => 'Sénégal',
                'nationality' => 'Sénégalaise',
                'accept_terms' => true,
                'role' => 'entreprise',
                'password' => Hash::make('entreprise123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Entreprise Beta Industries',
                'email' => 'beta@industries.sn',
                'phone' => '+221771234569',
                'country' => 'Sénégal',
                'nationality' => 'Sénégalaise',
                'accept_terms' => true,
                'role' => 'entreprise',
                'password' => Hash::make('entreprise123'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($entreprises as $entrepriseData) {
            $entreprise = User::firstOrCreate(
                ['email' => $entrepriseData['email']],
                $entrepriseData
            );

            // Créer des offres et services pour chaque entreprise
            $this->createOffresEtServices($entreprise->id);
        }
    }

    private function createOffresEtServices(int $entrepriseId): void
    {
        $offres = [
            [
                'type' => 'produit',
                'nom' => 'Carte de visite premium',
                'prix' => 25000,
                'identreprise' => $entrepriseId,
                'detail' => 'Carte de visite haute qualité avec finition premium',
            ],
            [
                'type' => 'produit',
                'nom' => 'Carte de visite standard',
                'prix' => 15000,
                'identreprise' => $entrepriseId,
                'detail' => 'Carte de visite standard avec impression de qualité',
            ],
            [
                'type' => 'service',
                'nom' => 'Service de conception graphique',
                'prix' => 50000,
                'identreprise' => $entrepriseId,
                'detail' => 'Conception personnalisée de votre carte de visite',
            ],
            [
                'type' => 'service',
                'nom' => 'Service de livraison express',
                'prix' => 10000,
                'identreprise' => $entrepriseId,
                'detail' => 'Livraison express sous 24h',
            ],
        ];

        foreach ($offres as $offre) {
            OffreEtService::firstOrCreate(
                [
                    'nom' => $offre['nom'],
                    'identreprise' => $entrepriseId,
                ],
                $offre
            );
        }
    }
}