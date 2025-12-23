<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'Africa Business Card') - Connectez entreprises et commerciaux</title>
    <meta name="description" content="@yield('description', 'Plateforme pour connecter entreprises et commerciaux. Publiez des offres, trouvez des clients et gagnez des commissions.')">
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Font Awesome Fallback - Fixed -->
    <style>
        /* Fallback icons for common Font Awesome classes - Only if Font Awesome fails to load */
        .fa-qrcode::before { content: '\f029'; }
        .fa-comments::before { content: '\f086'; }
        .fa-share-alt::before { content: '\f1e0'; }
        .fa-headphones::before { content: '\f025'; }
        .fa-user-check::before { content: '\f4fc'; }
        .fa-user-gear::before { content: '\f4fe'; }
        .fa-key::before { content: '\f084'; }
        .fa-plus::before { content: '\2b'; }
        .fa-palette::before { content: '\f53f'; }
        .fa-info-circle::before { content: '\f05a'; }
        .fa-gauge-high::before { content: '\f625'; }
        .fa-compass::before { content: '\f14e'; }
        .fa-box::before { content: '\f466'; }
        .fa-chart-bar::before { content: '\f080'; }
        .fa-bell::before { content: '\f0f3'; }
        .fa-share-alt::before { content: '\f1e0'; }
        .fa-address-book::before { content: '\f2bb'; }
        .fa-mobile-alt::before { content: '\f3cd'; }
        .fa-print::before { content: '\f02f'; }
        .fa-file-pdf::before { content: '\f1c1'; }
        .fa-envelope::before { content: '\f0e0'; }
        .fa-whatsapp::before { content: '\f232'; }
        .fa-facebook::before { content: '\f09a'; }
        .fa-linkedin::before { content: '\f08c'; }
        .fa-twitter::before { content: '\f099'; }
        .fa-rocket::before { content: '\f135'; }
        .fa-play-circle::before { content: '\f144'; }
        .fa-user::before { content: '\f007'; }
        .fa-star::before { content: '\f005'; }
        .fa-check::before { content: '\f00c'; }
        .fa-bars::before { content: '\f0c9'; }
    </style>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg,rgb(3, 40, 125) 5%, #061e57 75%)!important ;
        }
        .accent-color {
            color:rgb(245, 97, 11);
        }
        .accent-bg {
            background-color: rgb(245, 97, 11);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
    
    @stack('styles')
</head>
<!-- Remove any duplicate prompt.js scripts -->
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg sticky top-0 z-50" style="backgroundcolor: linear-gradient(135deg, #041E56FF 0%, #0F2C7C 100%) !important; color:white;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('landing.index') }}" class="flex items-center">
                            <img src="{{ asset('logo.jpeg') }}" alt="Africa Business Card" class="h-10 w-auto">
                            <span class="ml-2 text-2xl font-bold text-white">Africa Business Card</span>
                        </a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('landing.index') }}#accueil" class="text-white hover:text-yellow-300 font-medium">Accueil</a>
                    <a href="{{ route('landing.index') }}#fonctionnalites" class="text-white hover:text-yellow-300 font-medium">Fonctionnalités</a>
                    <a href="{{ route('landing.index') }}#abonnements" class="text-white hover:text-yellow-300 font-medium">Abonnements</a>
                    <a href="{{ route('landing.contact') }}" class="text-white hover:text-yellow-300 font-medium">Contact</a>
                    <button class="accent-bg text-blue-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                        Commencer maintenant
                    </button>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="text-white hover:text-yellow-300" onclick="toggleMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden gradient-bg border-t border-blue-800">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('landing.index') }}#accueil" class="block px-3 py-2 text-white hover:text-yellow-300">Accueil</a>
                <a href="{{ route('landing.index') }}#fonctionnalites" class="block px-3 py-2 text-white hover:text-yellow-300">Fonctionnalités</a>
                <a href="{{ route('landing.index') }}#abonnements" class="block px-3 py-2 text-white hover:text-yellow-300">Abonnements</a>
                <a href="{{ route('landing.contact') }}" class="block px-3 py-2 text-white hover:text-yellow-300">Contact</a>
                <button class="w-full text-left accent-bg text-blue-900 px-3 py-2 font-semibold">Commencer maintenant</button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <img src="{{ asset('logo.jpeg') }}" alt="Africa Business Card" class="h-8 w-auto mr-2">
                        <span>Africa Business Card</span>
                    </h3>
                    <p class="text-gray-400">
                        Connectons les entreprises et commerciaux africains pour booster les ventes et commissions.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Fonctionnalités</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Publication d'offres</a></li>
                        <li><a href="#" class="hover:text-white">Recherche de clients</a></li>
                        <li><a href="#" class="hover:text-white">Système de commission</a></li>
                        <li><a href="#" class="hover:text-white">Validation des ventes</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Abonnements</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Formule Junior</a></li>
                        <li><a href="#" class="hover:text-white">Formule Senior</a></li>
                        <li><a href="#" class="hover:text-white">Formule Manager</a></li>
                        <li><a href="#" class="hover:text-white">Formule Entreprise</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i>contact@africabusinesscard.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+225 XX XX XX XX</li>
                        <li class="flex space-x-4 mt-4">
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-whatsapp text-xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin text-xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Africa Business Card. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Navigation functionality is handled by resources/js/navigation.js -->
    @stack('scripts')
</body>
</html>