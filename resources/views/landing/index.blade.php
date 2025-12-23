@extends('layouts.landing')

@section('title', 'Africa Business Card - Connectez entreprises et commerciaux')
@section('description', 'La plateforme qui connecte les entreprises avec des commerciaux pour booster les ventes. Publiez vos offres, trouvez des clients et gagnez des commissions.')

@section('content')
    <!-- Hero Section -->
    <section id="accueil" class="hero-pattern text-white py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="inline-block mb-4">
                        <span class="accent-bg text-blue-900 px-4 py-2 rounded-full text-sm font-semibold">
                            🚀 La plateforme de vente en Afrique
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6" style="color:#06215e;">
                        Connectez entreprises et 
                        <span class="accent-color">commerciaux</span>
                        en Afrique
                    </h1>
                    <p class="text-xl mb-8" style="color:#333;">
                        La plateforme qui met en relation les entreprises avec des commerciaux pour booster les ventes et générer des commissions.
                    </p>
                    
                    <!-- Stats rapides -->
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold accent-color">500+</div>
                            <div class="text-sm text-gray-600">Entreprises</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold accent-color">2000+</div>
                            <div class="text-sm text-gray-600">Commerciaux</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold accent-color">15</div>
                            <div class="text-sm text-gray-600">Pays</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#abonnements" class="accent-bg text-blue-900 px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition-all transform hover:scale-105 flex items-center justify-center shadow-lg">
                            <i class="fas fa-rocket mr-2"></i>
                            Commencer maintenant
                        </a>
                        <a href="#comment-ca-marche" class="border-2 border-blue-900 text-blue-900 px-8 py-4 rounded-lg font-semibold hover:bg-blue-900 hover:text-white transition-all flex items-center justify-center">
                            <i class="fas fa-play-circle mr-2"></i>
                            Voir comment ça marche
                        </a>
                    </div>
                </div>
                
                <div class="relative" data-aos="fade-left">
                    <div class="absolute -top-4 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                    
                    <div class="relative bg-white rounded-3xl p-8 shadow-2xl transform hover:rotate-0 rotate-3 transition-transform duration-300">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6">
                            <!--  -->
                        <img src="portrait-young-happy-african-man-woman-showing-thumbs-up.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- How It Works Section -->
    <section id="comment-ca-marche" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Comment ça 
                    <span class="accent-color">marche ?</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    En 3 étapes simples, connectez entreprises et commerciaux pour booster les ventes
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <!-- Ligne de connexion entre les étapes (desktop) -->
                <div class="hidden md:block absolute top-10 left-1/4 right-1/4 h-1 bg-gradient-to-r from-blue-900 via-yellow-500 to-blue-900 opacity-20"></div>
                
                <div class="text-center relative" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg relative z-10">
                        <span class="text-white text-2xl font-bold">1</span>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Créez votre compte</h3>
                        <p class="text-gray-600">
                            Inscrivez-vous en tant qu'entreprise pour publier vos offres ou commercial pour trouver des clients.
                        </p>
                    </div>
                </div>
                
                <div class="text-center relative" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg relative z-10">
                        <span class="text-white text-2xl font-bold">2</span>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Publiez ou trouvez des offres</h3>
                        <p class="text-gray-600">
                            Entreprises : publiez vos services et produits. Commerciaux : trouvez des offres à promouvoir.
                        </p>
                    </div>
                </div>
                
                <div class="text-center relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg relative z-10">
                        <span class="text-white text-2xl font-bold">3</span>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Gagnez des commissions</h3>
                        <p class="text-gray-600">
                            Les commerciaux reçoivent des commissions sur chaque vente réalisée. L'équipe valide les achats.
                        </p>
                    </div>
                </div>
            </div>
            
     
        </div>
    </section>

    <!-- Features Section -->
    <section id="fonctionnalites" class="py-20 gradient-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Des fonctionnalités 
                    <span class="accent-color">puissantes</span>
                </h2>
                <p class="text-xl text-white max-w-3xl mx-auto">
                    Tout ce dont vous avez besoin pour connecter entreprises et commerciaux
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($features as $index => $feature)
                <div class="bg-white rounded-xl p-8 card-hover group" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-{{ $feature['icon'] }} text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Subscriptions Section -->
    <section id="abonnements" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Choisissez votre 
                    <span class="accent-color">formule</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Des solutions adaptées aux entreprises et commerciaux pour maximiser vos ventes
                </p>
                
            
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($subscriptions as $key => $subscription)
                <div class="bg-white rounded-xl p-8 shadow-lg card-hover relative transform hover:-translate-y-2 transition-all" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    @if($key == 'manager')
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="accent-bg text-blue-900 px-4 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ⭐ Populaire
                        </span>
                    </div>
                    @endif
                    
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $subscription['name'] }}</h3>
                        @if(isset($subscription['price_12']))
                            <div class="text-3xl font-bold accent-color mb-2">{{ $subscription['price_12'] }}</div>
                            <p class="text-sm text-gray-600">12 mois</p>
                            <p class="text-sm text-gray-600">ou {{ $subscription['price_24'] }} pour 24 mois</p>
                            @if(isset($subscription['price_12_premium']))
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <div class="text-lg font-bold accent-color mb-1">{{ $subscription['price_12_premium'] }}</div>
                                    <p class="text-xs text-gray-600">12 mois Premium</p>
                                    <p class="text-xs text-gray-600">ou {{ $subscription['price_24_premium'] }} pour 24 mois Premium</p>
                                </div>
                            @endif
                        @elseif(isset($subscription['manager_junior']))
                            <div class="text-sm text-gray-600 mb-2">{{ $subscription['age_junior'] }}</div>
                            <div class="text-lg font-bold accent-color mb-2">{{ $subscription['manager_junior'] }}</div>
                            <div class="text-sm text-gray-600 mt-3">{{ $subscription['age_senior'] }}</div>
                            <div class="text-lg font-bold accent-color mb-2">{{ $subscription['manager_senior'] }}</div>
                        @elseif(isset($subscription['price_range']))
                            <div class="text-lg font-bold accent-color mb-2">{{ $subscription['price_range'] }}</div>
                            <p class="text-sm text-gray-600">Selon vos besoins</p>
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <p class="text-xs text-gray-600 mb-1">Réseau Transactionnel:</p>
                                <div class="text-sm font-bold accent-color">{{ $subscription['transactionnel_12_5'] }} (12 mois, 1-5 offres)</div>
                                <div class="text-sm font-bold accent-color">{{ $subscription['transactionnel_24_20'] }} (24 mois, 11-20 offres)</div>
                                <p class="text-xs text-gray-600 mt-2 mb-1">Réseau Relationnel:</p>
                                <div class="text-sm font-bold accent-color">{{ $subscription['relationnel_12_5'] }} (12 mois, 1-5 offres)</div>
                                <div class="text-sm font-bold accent-color">{{ $subscription['relationnel_24_20'] }} (24 mois, 11-20 offres)</div>
                            </div>
                        @endif
                    </div>
                    
                    <ul class="space-y-3 mb-8">
                        @foreach($subscription['features'] as $feature)
                        <li class="flex items-start text-gray-600">
                            <i class="fas fa-check accent-color mr-3 mt-1 flex-shrink-0"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    
                    <button class="w-full gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-all transform hover:scale-105">
                        Choisir {{ $subscription['name'] }}
                    </button>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12" data-aos="fade-up">
                <p class="text-gray-600 mb-4">Besoin d'une solution personnalisée pour votre entreprise ?</p>
                <a href="#contact" class="inline-block border-2 border-blue-900 text-blue-900 px-8 py-3 rounded-lg font-semibold hover:bg-blue-900 hover:text-white transition-all">
                    Contactez notre équipe commerciale
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section (Nouvelle) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Ils nous font 
                    <span class="accent-color">confiance</span>
                </h2>
                <p class="text-xl text-gray-600">Découvrez comment ils boostent leurs ventes</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-blue-50 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Amadou Diallo</h4>
                            <p class="text-sm text-gray-600">PDG Entreprise Tech, Sénégal</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Grâce à cette plateforme, j'ai trouvé des commerciaux talentueux qui ont boosté mes ventes de 40% !"</p>
                    <div class="mt-4 text-yellow-500">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <div class="bg-blue-50 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Marie Kouassi</h4>
                            <p class="text-sm text-gray-600">Commerciale Indépendante, Côte d'Ivoire</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Je gagne maintenant des commissions sur chaque vente que je réalise pour les entreprises partenaires !"</p>
                    <div class="mt-4 text-yellow-500">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <div class="bg-blue-50 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">David Mensah</h4>
                            <p class="text-sm text-gray-600">Commercial Freelance, Ghana</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"J'ai multiplié mes revenus grâce aux commissions sur les ventes que je génère pour les entreprises."</p>
                    <div class="mt-4 text-yellow-500">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section (Nouvelle) -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Questions 
                    <span class="accent-color">fréquentes</span>
                </h2>
            </div>
            
            <div class="space-y-4" data-aos="fade-up">
                <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-lg transition-shadow">
                    <summary class="font-semibold text-gray-900 text-lg">Comment fonctionne le système de commissions ?</summary>
                    <p class="mt-4 text-gray-600">Les commerciaux reçoivent une commission sur chaque vente validée. Le montant varie selon les offres, allant de 5% à 20% du montant de la vente.</p>
                </details>
                
                <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-lg transition-shadow">
                    <summary class="font-semibold text-gray-900 text-lg">Comment les entreprises paient-elles les commissions ?</summary>
                    <p class="mt-4 text-gray-600">Les commissions sont versées automatiquement après validation de la vente par l'équipe Africa Business Card. Les paiements se font par mobile money ou virement bancaire.</p>
                </details>
                
                <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-lg transition-shadow">
                    <summary class="font-semibold text-gray-900 text-lg">Qui valide les ventes et les commissions ?</summary>
                    <p class="mt-4 text-gray-600">L'équipe Africa Business Card vérifie et valide chaque transaction pour garantir la sécurité et la fiabilité de la plateforme. La validation se fait sous 24-48h.</p>
                </details>
                
                <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-lg transition-shadow">
                    <summary class="font-semibold text-gray-900 text-lg">Puis-je être à la fois entreprise et commercial ?</summary>
                    <p class="mt-4 text-gray-600">Oui ! Vous pouvez créer des offres en tant qu'entreprise et également promouvoir des offres d'autres entreprises pour gagner des commissions.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg py-20">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                Prêt à booster vos ventes ?
            </h2>
            <p class="text-xl text-white mb-8 opacity-90">
                Rejoignez des centaines d'entreprises et commerciaux qui augmentent leurs revenus avec Africa Business Card
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="accent-bg text-blue-900 px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition-all transform hover:scale-105 text-lg shadow-xl">
                    <i class="fas fa-rocket mr-2"></i>
                    Commencer maintenant
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-blue-900 transition-all text-lg">
                    <i class="fas fa-info-circle mr-2"></i>
                    En savoir plus
                </button>
            </div>
            
            <!-- Trust badges -->
        
        </div>
    </section>

@endsection