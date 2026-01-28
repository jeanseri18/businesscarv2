<?php

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


// ROUTE API POUR AUTH (Inscription, Connexion, Déconnexion)
    // Routes publiques
        Route::post('/inscription', [AuthController::class, 'inscription']);
        Route::post('/connexion', [AuthController::class, 'connexion']);

    // Routes protégées
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/deconnexion', [AuthController::class, 'deconnexion']);
    });