<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OffreEtServiceController;


// ROUTE API POUR AUTH (Inscription, Connexion, Déconnexion)
    // Routes publiques
        Route::post('/inscription', [AuthController::class, 'inscription']);
        Route::post('/connexion', [AuthController::class, 'connexion']);

    // Routes protégées
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/deconnexion', [AuthController::class, 'deconnexion']);
    });



// ROUTE API POUR OFFRE/SERVICE DES ENTREPRISES (Ajouter ,lister, modifier et supprimer par produit/offre)
    // Routes publiques (Afficher les offres)
    Route::get('/offres', [OffreEtServiceController::class, 'index']);
    Route::get('/offres/{id}', [OffreEtServiceController::class, 'show']);

    // Routes protégées (Créer, modifier et supprimer une offre)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/offres', [OffreEtServiceController::class, 'store']);
        Route::put('/offres/{id}', [OffreEtServiceController::class, 'update']);
        Route::delete('/offres/{id}', [OffreEtServiceController::class, 'destroy']);
    });