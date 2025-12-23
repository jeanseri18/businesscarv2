<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommercialController;

// Landing page routes
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/a-propos', [LandingController::class, 'about'])->name('landing.about');
Route::get('/fonctionnalites', [LandingController::class, 'features'])->name('landing.features');
Route::get('/abonnements', [LandingController::class, 'pricing'])->name('landing.pricing');
Route::get('/contact', [LandingController::class, 'contact'])->name('landing.contact');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Users management
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/users/{user}', [AdminController::class, 'userDetails'])->name('users.details');
        Route::post('/users/{user}/status', [AdminController::class, 'updateUserStatus'])->name('users.update-status');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');

        // Enterprises management
        Route::get('/enterprises', [AdminController::class, 'enterprises'])->name('enterprises.index');
        Route::get('/enterprises/{enterprise}', [AdminController::class, 'enterpriseDetails'])->name('enterprises.details');
        Route::post('/enterprises/{enterprise}/status', [AdminController::class, 'updateEnterpriseStatus'])->name('enterprises.update-status');
        Route::delete('/enterprises/{enterprise}', [AdminController::class, 'deleteEnterprise'])->name('enterprises.destroy');

        // Commercial users management
        Route::get('/commerciaux', [AdminController::class, 'commerciaux'])->name('commerciaux.index');
        Route::get('/commerciaux/{commercial}', [AdminController::class, 'commercialDetails'])->name('commerciaux.details');
        Route::post('/commerciaux/{commercial}/status', [AdminController::class, 'updateCommercialStatus'])->name('commerciaux.update-status');
        Route::delete('/commerciaux/{commercial}', [AdminController::class, 'deleteCommercial'])->name('commerciaux.destroy');

        // Subscriptions management
        Route::get('/subscriptions', [AdminController::class, 'subscriptions'])->name('subscriptions.index');
        Route::get('/subscriptions/{subscription}', [AdminController::class, 'subscriptionDetails'])->name('subscriptions.details');
        Route::post('/subscriptions/{subscription}/status', [AdminController::class, 'updateSubscriptionStatus'])->name('subscriptions.update-status');
        Route::delete('/subscriptions/{subscription}', [AdminController::class, 'deleteSubscription'])->name('subscriptions.destroy');

        // Payments management
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments.index');
        Route::get('/payments/{payment}', [AdminController::class, 'paymentDetails'])->name('payments.details');
        Route::post('/payments/{payment}/status', [AdminController::class, 'updatePaymentStatus'])->name('payments.update-status');
        Route::delete('/payments/{payment}', [AdminController::class, 'deletePayment'])->name('payments.destroy');

        // Purchases management
        Route::get('/purchases', [AdminController::class, 'achats'])->name('purchases.index');
        Route::get('/purchases/{achat}', [AdminController::class, 'achatDetails'])->name('purchases.details');
        Route::post('/purchases/{achat}/status', [AdminController::class, 'updateAchatStatus'])->name('purchases.update-status');
        Route::delete('/purchases/{achat}', [AdminController::class, 'deleteAchat'])->name('purchases.destroy');

        // Offers management
        Route::get('/offres', [AdminController::class, 'offres'])->name('offres.index');
        
        // Profile management
        Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile/password', [AdminController::class, 'editPassword'])->name('profile.password');
        Route::post('/profile/password', [AdminController::class, 'updatePassword'])->name('profile.password.update');
        
        // Purchases management (add store route)
        Route::post('/achats', [AdminController::class, 'storeAchat'])->name('achats.store');

        // AJAX routes for status updates
        Route::prefix('ajax')->name('ajax.')->group(function () {
            Route::post('/subscriptions/{subscription}/status', [AdminController::class, 'ajaxUpdateSubscriptionStatus'])->name('subscriptions.update-status');
            Route::post('/payments/{payment}/status', [AdminController::class, 'ajaxUpdatePaymentStatus'])->name('payments.update-status');
            Route::post('/purchases/{achat}/status', [AdminController::class, 'ajaxUpdateAchatStatus'])->name('purchases.update-status');
        });
    });
});

// Test route for debugging enterprises
require __DIR__.'/web_test.php';

// Public product link route (no authentication required)
Route::get('/produit/{id}', [LandingController::class, 'lienProduit'])
    ->name('produit.public')
    ->where('id', '[0-9]+');

// Public purchase store route (no authentication required)
Route::post('/achat/store', [AdminController::class, 'storeAchatPublic'])
    ->name('achat.store.public');

// Enterprise routes
Route::prefix('entreprise')->name('entreprise.')->group(function () {
    // Authentication routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    // Protected enterprise routes
    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\EntrepriseController::class, 'dashboard'])->name('dashboard');
        
        // Historique des souscriptions
        Route::get('/souscriptions', [\App\Http\Controllers\EntrepriseController::class, 'souscriptions'])->name('souscriptions');
        Route::get('/souscriptions/{id}', [\App\Http\Controllers\EntrepriseController::class, 'detailsSouscription'])->name('souscriptions.details');
        
        // Gestion des offres
        Route::get('/offres', [\App\Http\Controllers\EntrepriseController::class, 'offres'])->name('offres');
        Route::get('/offres/create', [\App\Http\Controllers\EntrepriseController::class, 'createOffre'])->name('offres.create');
        Route::post('/offres', [\App\Http\Controllers\EntrepriseController::class, 'storeOffre'])->name('offres.store');
        Route::get('/offres/{offre}/edit', [\App\Http\Controllers\EntrepriseController::class, 'editOffre'])->name('offres.edit');
        Route::put('/offres/{offre}', [\App\Http\Controllers\EntrepriseController::class, 'updateOffre'])->name('offres.update');
        Route::delete('/offres/{offre}', [\App\Http\Controllers\EntrepriseController::class, 'deleteOffre'])->name('offres.destroy');
        
        // Gestion du profil
        Route::get('/profile/edit', [\App\Http\Controllers\EntrepriseController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [\App\Http\Controllers\EntrepriseController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile/password', [\App\Http\Controllers\EntrepriseController::class, 'editPassword'])->name('profile.password');
        Route::post('/profile/password', [\App\Http\Controllers\EntrepriseController::class, 'updatePassword'])->name('profile.password.update');
    });
});

// Commercial routes
Route::prefix('commercial')->name('commercial.')->group(function () {
    // Authentication routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    // Protected commercial routes
    Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [CommercialController::class, 'dashboard'])->name('dashboard');
    
    // Historique des souscriptions
    Route::get('/souscriptions', [CommercialController::class, 'souscriptions'])->name('souscriptions');
    Route::get('/souscriptions/{id}', [CommercialController::class, 'detailsSouscription'])->name('souscriptions.details');
    
    // Liste des ventes
    Route::get('/ventes', [CommercialController::class, 'ventes'])->name('ventes');
    Route::get('/ventes/{id}', [CommercialController::class, 'detailsVente'])->name('ventes.details');
    
    // Offres disponibles
    Route::get('/offres', [CommercialController::class, 'offres'])->name('offres');
    Route::get('/offres/{id}', [CommercialController::class, 'detailsOffre'])->name('offres.details');
    
    // Commissions
    Route::get('/commissions', [CommercialController::class, 'commissions'])->name('commissions');
    
    // Entreprises partenaires
    Route::get('/entreprises', [CommercialController::class, 'entreprises'])->name('entreprises');
    Route::get('/entreprises/{entreprise}', [CommercialController::class, 'detailsEntreprise'])->name('entreprises.details');
    
    // Gestion du profil
    Route::get('/profile/edit', [CommercialController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [CommercialController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/password', [CommercialController::class, 'editPassword'])->name('profile.password');
    Route::post('/profile/password', [CommercialController::class, 'updatePassword'])->name('profile.password.update');
    });
});
