<?php

namespace Database\Seeders;

use App\Models\Achat;
use App\Models\OffreEtService;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AchatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer tous les produits et services
        $produitsServices = OffreEtService::all();
        
        // Récupérer quelques utilisateurs (entreprises et normaux)
        $users = User::whereIn('role', ['user', 'entreprise'])->limit(10)->get();
        
        // Récupérer quelques commerciaux
        $commerciaux = User::where('role', 'commercial')->get();

        $statuses = ['en_attente', 'confirme', 'livre', 'annule'];
        $types = ['produit', 'service'];
        $firstNames = ['Jean', 'Marie', 'Pierre', 'Fatou', 'Moussa', 'Awa', 'Ousmane', 'Mariama'];
        $lastNames = ['Diop', 'Ndiaye', 'Sow', 'Ba', 'Fall', 'Gueye', 'Cissé', 'Sy'];

        foreach ($users as $user) {
            // Créer entre 1 et 3 achats par utilisateur
            $nombreAchats = rand(1, 3);
            
            for ($i = 0; $i < $nombreAchats; $i++) {
                $produitService = $produitsServices->random();
                $status = $statuses[array_rand($statuses)];
                $quantite = rand(1, 5);
                $commercial = $commerciaux->random();
                
                // Toujours définir une date de livraison, même pour les commandes en attente
                $dateLivraison = Carbon::now()->addDays(rand(1, 30));

                Achat::create([
                    'nom' => $lastNames[array_rand($lastNames)],
                    'prenom' => $firstNames[array_rand($firstNames)],
                    'type' => $produitService->type,
                    'whatsapp' => '+221' . rand(70, 78) . rand(100000, 999999),
                    'code_commercial' => $commercial->id,
                    'quantite' => $quantite,
                    'description' => 'Achat de ' . $quantite . ' ' . $produitService->nom,
                    'lieu_livraison' => 'Dakar, Sénégal',
                    'date_livraison' => $dateLivraison,
                    'statut' => $status,
                    'id_produit_service' => $produitService->id,
                ]);
            }
        }

        // Créer quelques achats supplémentaires avec des statuts spécifiques
        $this->createAdditionalAchats($produitsServices, $commerciaux, $firstNames, $lastNames);
    }

    private function createAdditionalAchats($produitsServices, $commerciaux, $firstNames, $lastNames): void
    {
        // Créer des achats récents en attente
        for ($i = 0; $i < 5; $i++) {
            $produitService = $produitsServices->random();
            $commercial = $commerciaux->random();
            
            Achat::create([
                'nom' => $lastNames[array_rand($lastNames)],
                'prenom' => $firstNames[array_rand($firstNames)],
                'type' => $produitService->type,
                'whatsapp' => '+221' . rand(70, 78) . rand(100000, 999999),
                'code_commercial' => $commercial->id,
                'quantite' => rand(1, 3),
                'description' => 'Achat récent de ' . $produitService->nom,
                'lieu_livraison' => 'Dakar, Sénégal',
                'date_livraison' => Carbon::now()->addDays(rand(1, 14)),
                'statut' => 'en_attente',
                'id_produit_service' => $produitService->id,
            ]);
        }

        // Créer des achats confirmés
        for ($i = 0; $i < 3; $i++) {
            $produitService = $produitsServices->random();
            $commercial = $commerciaux->random();
            
            Achat::create([
                'nom' => $lastNames[array_rand($lastNames)],
                'prenom' => $firstNames[array_rand($firstNames)],
                'type' => $produitService->type,
                'whatsapp' => '+221' . rand(70, 78) . rand(100000, 999999),
                'code_commercial' => $commercial->id,
                'quantite' => rand(2, 4),
                'description' => 'Achat confirmé de ' . $produitService->nom,
                'lieu_livraison' => 'Thiès, Sénégal',
                'date_livraison' => Carbon::now()->addDays(rand(3, 21)),
                'statut' => 'confirme',
                'id_produit_service' => $produitService->id,
            ]);
        }

        // Créer des achats livrés
        for ($i = 0; $i < 4; $i++) {
            $produitService = $produitsServices->random();
            $commercial = $commerciaux->random();
            
            Achat::create([
                'nom' => $lastNames[array_rand($lastNames)],
                'prenom' => $firstNames[array_rand($firstNames)],
                'type' => $produitService->type,
                'whatsapp' => '+221' . rand(70, 78) . rand(100000, 999999),
                'code_commercial' => $commercial->id,
                'quantite' => rand(1, 5),
                'description' => 'Achat livré de ' . $produitService->nom,
                'lieu_livraison' => 'Mbour, Sénégal',
                'date_livraison' => Carbon::now()->subDays(rand(1, 30)),
                'statut' => 'livre',
                'id_produit_service' => $produitService->id,
            ]);
        }
    }
}