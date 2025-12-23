<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Entreprise') - Africa Business Card</title>
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #041E56FF 0%, #0F2C7C 100%);
        }
        .accent-color {
            color: #F5E50BFF;
        }
        .accent-bg {
            background-color: #F5E50BFF;
        }
        .sidebar-item {
            transition: all 0.3s ease;
        }
        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar-item.active {
            background-color: rgba(245, 229, 11, 0.2);
            border-left: 4px solid #F5E50BFF;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        /* Empêcher le défilement horizontal */
        html, body {
            overflow-x: hidden;
            width: 100%;
        }
        .flex-1 {
            min-width: 0;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 gradient-bg text-white flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-white border-opacity-20">
                <div class="flex items-center">
                    <img src="{{ asset('logo.jpeg') }}" alt="Africa Business Card" class="h-8 w-auto mr-3">
                    <div>
                        <h1 class="text-lg font-bold">Entreprise ABC</h1>
                        <p class="text-xs opacity-75">Business Card</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('entreprise.dashboard') }}" 
                           class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('entreprise.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('entreprise.souscriptions') }}" 
                           class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('entreprise.souscriptions*') ? 'active' : '' }}">
                            <i class="fas fa-history mr-3 w-5 text-center"></i>
                            <span>Historique</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('entreprise.offres') }}" 
                           class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('entreprise.offres*') ? 'active' : '' }}">
                            <i class="fas fa-tags mr-3 w-5 text-center"></i>
                            <span>Offres</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Profile & Logout -->
            <div class="p-4 border-t border-white border-opacity-20">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Entreprise' }}</p>
                        <p class="text-xs opacity-75">Entreprise</p>
                    </div>
                </div>
                
                <!-- Profile Menu -->
                <div class="space-y-1 mb-3">
                    <a href="{{ route('entreprise.profile.edit') }}" 
                       class="sidebar-item flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('entreprise.profile.edit') ? 'active' : '' }}">
                        <i class="fas fa-user-edit mr-3 w-5 text-center"></i>
                        <span>Modifier profil</span>
                    </a>
                    <a href="{{ route('entreprise.profile.password') }}" 
                       class="sidebar-item flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('entreprise.profile.password') ? 'active' : '' }}">
                        <i class="fas fa-key mr-3 w-5 text-center"></i>
                        <span>Changer mot de passe</span>
                    </a>
                </div>
                
                <form method="POST" action="{{ route('entreprise.logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-item flex items-center px-4 py-2 rounded-lg w-full">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">@yield('page_title', 'Tableau de bord')</h2>
                            <p class="text-gray-600">@yield('page_subtitle', 'Gestion de votre entreprise')</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ now()->format('d/m/Y') }}
                            </span>
                            <span class="text-sm text-gray-500">
                                <i class="far fa-clock mr-1"></i>
                                {{ now()->format('H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-3">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-3">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto flex flex-col">
                @yield('content')
            </main>

            <!-- Footer -->
            <!-- <footer class="bg-white border-t px-6 py-4">
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <p>&copy; 2024 Africa Business Card. Tous droits réservés.</p>
                    <p>Version 1.0.0</p>
                </div>
            </footer> -->
        </div>
    </div>

    <script>
        // Auto-hide flash messages after 5 seconds
        setTimeout(function() {
            const flashMessages = document.querySelectorAll('.bg-green-50, .bg-red-50');
            flashMessages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s';
                message.style.opacity = '0';
                setTimeout(function() {
                    message.remove();
                }, 500);
            });
        }, 5000);

        // Confirm delete actions
        function confirmDelete(message = 'Êtes-vous sûr de vouloir supprimer cet élément ?') {
            return confirm(message);
        }

        // Copy to clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Copié dans le presse-papiers !');
            });
        }
    </script>

    @stack('scripts')
</body>
</html>