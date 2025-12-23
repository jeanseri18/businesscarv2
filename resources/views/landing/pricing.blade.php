@extends('layouts.landing')

@section('title', 'Abonnements')
@section('description', 'Choisissez l\'offre qui correspond à votre profil : entreprise ou commercial. Des plans flexibles pour maximiser vos revenus.')

@section('content')
<!-- Pricing Hero -->
<section class="gradient-bg text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Nos abonnements</h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto">
            Choisissez l'offre qui correspond à votre profil : entreprise ou commercial. Des plans flexibles pour maximiser vos revenus.
        </p>
    </div>
</section>

<!-- Pricing Plans -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-8">
            <!-- Junior Plan -->
            <div class="bg-white rounded-2xl shadow-lg p-8 card-hover relative">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Commercial Junior</h3>
                    <p class="text-gray-600 mb-4">Parfait pour les commerciaux débutants</p>
                    <div class="text-4xl font-bold gradient-text mb-1">10 000 FCFA</div>
                    <p class="text-gray-500">12 mois</p>
                    <p class="text-sm text-gray-400 mt-2">ou 15 000 FCFA pour 24 mois</p>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Accès aux offres publiques</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Profil commercial personnalisable</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Système de commission basique</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Suivi des ventes et commissions</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Support email</span>
                    </li>

                </ul>
                
                <button class="w-full gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-colors">
                    Commencer
                </button>
            </div>
            
            <!-- Senior Plan -->
            <div class="bg-white rounded-2xl shadow-xl p-8 card-hover relative border-4 border-blue-500">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Recommandé</span>
                </div>
                
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Commercial Senior</h3>
                    <p class="text-gray-600 mb-4">Pour commerciaux expérimentés</p>
                    <div class="text-4xl font-bold gradient-text mb-1">12 000 FCFA</div>
                    <p class="text-gray-500">12 mois Standard</p>
                    <p class="text-sm text-gray-400 mt-2">20 000 FCFA (24 mois Standard) / 20 000 FCFA (12 mois Premium) / 30 000 FCFA (24 mois Premium)</p>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Accès premium aux offres</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Profil premium avec badge vérifié</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Commissions majorées</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Outils de prospection avancés</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Support prioritaire dédié</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Statistiques détaillées de performance</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Messagerie directe avec entreprises</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Accès aux offres exclusives</span>
                    </li>

                </ul>
                
                <button class="w-full gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-colors">
                    Commencer
                </button>
            </div>
            
            <!-- Manager Plan -->
            <div class="bg-white rounded-2xl shadow-lg p-8 card-hover relative">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Entreprise</h3>
                    <p class="text-gray-600 mb-4">Pour petites et moyennes entreprises</p>
                    <div class="text-lg font-bold gradient-text mb-2">Rémunération basée sur l'expérience</div>
                    <p class="text-sm text-gray-600">Manager Junior (25-35 ans): 500 000 - 5 000 000 FCFA</p>
                    <p class="text-sm text-gray-600">Manager Senior (+35 ans): 750 000 - 7 000 000 FCFA</p>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Accès réseau professionnel premium</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Outils de gestion avancés</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Support prioritaire</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Analytiques détaillées</span>
                    </li>
                </ul>
                
                <button class="w-full accent-bg text-blue-900 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                    Commencer
                </button>
            </div>
            <!-- Enterprise Plan -->
            <div class="bg-white rounded-2xl shadow-lg p-8 card-hover relative mt-8">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Entreprise</h3>
                    <p class="text-gray-600 mb-4">Pour les grandes organisations</p>
                    <div class="text-lg font-bold gradient-text mb-2">50 000 - 180 000 FCFA</div>
                    <p class="text-sm text-gray-600">selon le nombre d'offres et durée</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-900 mb-2">Réseau Transactionnel</h4>
                        <ul class="space-y-1 text-sm text-gray-700">
                            <li>• 50 000 FCFA (12 mois, 1-5 offres)</li>
                            <li>• 80 000 FCFA (12 mois, 6-10 offres)</li>
                            <li>• 100 000 FCFA (24 mois, 1-5 offres)</li>
                            <li>• 120 000 FCFA (24 mois, 11-20 offres)</li>
                        </ul>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <h4 class="font-semibold text-yellow-800 mb-2">Réseau Relationnel</h4>
                        <ul class="space-y-1 text-sm text-gray-700">
                            <li>• 75 000 FCFA (12 mois, 1-5 offres)</li>
                            <li>• 120 000 FCFA (12 mois, 6-10 offres)</li>
                            <li>• 135 000 FCFA (24 mois, 1-5 offres)</li>
                            <li>• 180 000 FCFA (24 mois, 11-20 offres)</li>
                        </ul>
                    </div>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Comptes d'équipe multiples</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Gestion des commerciaux</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Gestion avancée des produits</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Accès aux commerciaux vérifiés</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Support dédié aux entreprises</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Formation commerciale incluse</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 gradient-bg rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700">Rapports personnalisés</span>
                    </li>
                </ul>
                
                <button class="w-full accent-bg text-blue-900 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                    Commencer
                </button>
            </div>
        </div>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Questions fréquentes</h2>
            <p class="text-xl text-gray-600">Contactez-nous pour plus d'informations sur nos formules.</p>
        </div>
        
        <div class="space-y-6">
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Comment puis-je m'abonner ?</h3>
                <p class="text-gray-600">Contactez notre équipe commerciale pour discuter de vos besoins et choisir la formule adaptée.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Quels sont les modes de paiement ?</h3>
                <p class="text-gray-600">Plusieurs options de paiement sont disponibles selon votre localisation et préférences.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Le support est-il inclus ?</h3>
                <p class="text-gray-600">Oui, toutes nos formules incluent un support adapté à vos besoins.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="gradient-bg py-16">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-white mb-6">Intéressé par nos services ?</h2>
        <p class="text-xl text-gray-200 mb-8">
            Contactez-nous pour discuter de vos besoins et trouver la solution adaptée.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="accent-bg text-blue-900 px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors text-lg">
                <i class="fab fa-google-play mr-2"></i>
                Télécharger l'application
            </button>
            <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-blue-900 transition-colors text-lg">
                Nous contacter
            </button>
        </div>
    </div>
</section>
@endsection