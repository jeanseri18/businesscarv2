@extends('layouts.landing')

@section('title', 'À propos')
@section('description', 'Découvrez Africa Business Card, notre mission de connecter entreprises et commerciaux pour booster les ventes en Afrique.')

@section('content')
<!-- About Hero -->
<section class="gradient-bg text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">À propos de nous</h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto">
            Nous connectons les entreprises avec des commerciaux pour booster les ventes et créer des opportunités de revenus en Afrique.
        </p>
    </div>
</section>

<!-- Mission Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Notre mission</h2>
                <div class="space-y-4 text-gray-600">
                    <p>
                        Chez Africa Business Card, nous croyons que les entreprises et commerciaux africains méritent une plateforme moderne pour maximiser leurs ventes.
                    </p>
                    <p>
                        Notre mission est de connecter les entreprises avec des commerciaux talentueux pour booster les ventes et créer des opportunités de revenus durables.
                    </p>
                    <p>
                        Nous visons à créer un écosystème où les entreprises peuvent publier leurs offres et les commerciaux peuvent les promouvoir contre des commissions attractives.
                    </p>
                </div>
                
                <div class="mt-8 grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold accent-color mb-2">500+</div>
                        <div class="text-gray-600">Entreprises partenaires</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold accent-color mb-2">2000+</div>
                        <div class="text-gray-600">Commerciaux actifs</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-handshake text-3xl accent-color mb-2"></i>
                            <h4 class="font-semibold text-gray-900">Connecté</h4>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-chart-line text-3xl accent-color mb-2"></i>
                            <h4 class="font-semibold text-gray-900">Rentable</h4>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-users text-3xl accent-color mb-2"></i>
                            <h4 class="font-semibold text-gray-900">Collaboratif</h4>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-rocket text-3xl accent-color mb-2"></i>
                            <h4 class="font-semibold text-gray-900">Performant</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Objectifs Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos objectifs</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Quatre piliers fondamentaux pour connecter entreprises et commerciaux en Afrique.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-xl p-6 text-center card-hover">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-recycle text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Connexion</h3>
                <p class="text-gray-600">Mettre en relation les entreprises avec des commerciaux qualifiés pour booster les ventes.</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 text-center card-hover">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-universal-access text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Rentabilité</h3>
                <p class="text-gray-600">Créer des opportunités de revenus pour les commerciaux et augmenter les ventes des entreprises.</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 text-center card-hover">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-network-wired text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Collaboration</h3>
                <p class="text-gray-600">Favoriser le travail collaboratif entre entreprises et commerciaux pour maximiser les résultats.</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 text-center card-hover">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-magic text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Performance</h3>
                <p class="text-gray-600">Optimiser les performances de vente grâce à une plateforme moderne et intuitive.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre équipe</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Une équipe passionnée et talentueuse dédiée à transformer le réseautage professionnel en Afrique.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-32 h-32 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Jean Koffi</h3>
                <p class="accent-color font-medium mb-2">Développeur Principal</p>
                <p class="text-gray-600">Expert en développement mobile et passionné par l'innovation technologique en Afrique.</p>
            </div>
            
            <div class="text-center">
                <div class="w-32 h-32 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Awa Diallo</h3>
                <p class="accent-color font-medium mb-2">Designer UI/UX</p>
                <p class="text-gray-600">Créatrice d'expériences utilisateur exceptionnelles avec un regard africain moderne.</p>
            </div>
            
            <div class="text-center">
                <div class="w-32 h-32 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Mamadou Traoré</h3>
                <p class="accent-color font-medium mb-2">Chef de Projet</p>
                <p class="text-gray-600">Stratège digital avec une vision claire de l'avenir du réseautage professionnel.</p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos valeurs</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-handshake text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Collaboration</h3>
                        <p class="text-gray-600">Nous croyons en la puissance du travail d'équipe et des partenariats pour créer un impact durable.</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-lightbulb text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Innovation</h3>
                        <p class="text-gray-600">Nous repoussons les limites de la technologie pour créer des solutions adaptées au contexte africain.</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Communauté</h3>
                        <p class="text-gray-600">Nous mettons notre communauté au centre de tout ce que nous faisons, en écoutant et en répondant à ses besoins.</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Excellence</h3>
                        <p class="text-gray-600">Nous nous engageons à fournir des produits et services de la plus haute qualité à nos utilisateurs.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="gradient-bg py-16">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-white mb-6">Rejoignez notre mission</h2>
        <p class="text-xl text-gray-200 mb-8">
            Ensemble, nous pouvons transformer le réseautage professionnel en Afrique et créer des opportunités pour tous.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="accent-bg text-blue-900 px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors text-lg">
                Télécharger l'application
            </button>
            <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-blue-900 transition-colors text-lg">
                Nous contacter
            </button>
        </div>
    </div>
</section>
@endsection