<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OffreEtService;
use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        $features = [
            [
                'title' => 'Carte de Visite Numérique',
                'description' => 'Créez et personnalisez votre carte de visite numérique avec des templates africains modernes',
                'icon' => 'id-card'
            ],
            [
                'title' => 'QR Code Dynamique',
                'description' => 'Génération automatique de QR code pour un partage rapide et facile',
                'icon' => 'qrcode'
            ],
            [
                'title' => 'Chat Intégré',
                'description' => 'Communiquez directement avec d\'autres professionnels via notre messagerie intégrée',
                'icon' => 'comments'
            ],
            [
                'title' => 'Marketplace B2B',
                'description' => 'Plateforme de vente collaborative entre entreprises et commerciaux',
                'icon' => 'store'
            ],
            [
                'title' => 'Système d\'Abonnement',
                'description' => 'Formules adaptées à tous les besoins : Junior, Senior, Manager et Entreprise',
                'icon' => 'crown'
            ],
            [
                'title' => 'Partage Multicanal',
                'description' => 'Partagez votre carte par email, SMS, réseaux sociaux ou sauvegarde dans les contacts',
                'icon' => 'share-alt'
            ]
        ];

        $subscriptions = [
            'junior' => [
                'name' => 'Formule Junior',
                'price_12' => '10 000 FCFA',
                'price_24' => '15 000 FCFA',
                'features' => ['Carte de visite numérique','Accès catalogue produit', 'QR Code dynamique', 'Partage multicanal', 'Support email']
            ],
            'senior' => [
                'name' => 'Formule Senior',
                'price_12' => '12 000 FCFA',
                'price_24' => '20 000 FCFA',
                'price_12_premium' => '20 000 FCFA',
                'price_24_premium' => '30 000 FCFA',
                'features' => ['Toutes les fonctionnalités Junior','Accès catalogue produit', 'Support prioritaire']
            ],
            'manager' => [
                'name' => 'Formule Manager',
                'manager_junior' => '500 000 - 5 000 000 FCFA',
                'manager_senior' => '750 000 - 7 000 000 FCFA',
                'age_junior' => '25-35 ans',
                'age_senior' => '+35 ans',
                'features' => ['Réseau transactionnel/relationnel', 'Accès catalogue produit', 'Outils avancés', 'Support dédié']
            ],
            'enterprise' => [
                'name' => 'Formule Entreprise',
                'price_range' => '50 000 - 180 000 FCFA',
                'transactionnel_12_5' => '50 000 FCFA',
                'transactionnel_24_20' => '120 000 FCFA',
                'relationnel_12_5' => '75 000 FCFA',
                'relationnel_24_20' => '180 000 FCFA',
                'features' => ['Multi-utilisateurs', 'Support premium 24/7']
            ]
        ];

        return view('landing.index', compact('features', 'subscriptions'));
    }

    public function about()
    {
        return view('landing.about');
    }

    public function features()
    {
        return view('landing.features');
    }

    public function pricing()
    {
        return view('landing.pricing');
    }

    public function contact()
    {
        return view('landing.contact');
    }

    public function lienProduit($id)
    {
        // Récupérer le code_commercial depuis l'URL
        $codeCommercial = request('code_commercial');
        
        // Trouver l'offre/produit
        $offre = OffreEtService::findOrFail($id);
        
        // Récupérer l'entreprise associée à l'offre
        $entreprise = $offre->entreprise;
        
        // Si un code commercial est fourni, vérifier qu'il existe
        if ($codeCommercial) {
            $commercial = User::where('code_commercial', $codeCommercial)->first();
            if (!$commercial) {
                // Code commercial invalide, mais on continue quand même
                $codeCommercial = null;
            }
        }
        
        return view('lienproduit', compact('offre', 'entreprise', 'codeCommercial'));
    }
}