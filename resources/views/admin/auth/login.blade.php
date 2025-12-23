<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ request()->is('commercial/*') ? 'Commercial' : 'Administration' }} - Africa Business Card</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
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
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <h1 class="text-3xl font-bold gradient-bg bg-clip-text text-transparent">
                    Africa Business Card
                </h1>
            </div>
            <p class="text-gray-600">Espace {{ request()->is('commercial/*') ? 'commercial' : 'd\'administration' }}</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
            <div class="text-center mb-6">
           <center>     <img src="{{ asset('logo.jpeg') }}" alt="Africa Business Card" class="h-12 w-auto mr-3  rounded-full"></center>
                <h2 class="text-2xl font-bold text-gray-900">Connexion {{ request()->is('commercial/*') ? 'Commercial' : 'Admin' }}</h2>
                <p class="text-gray-600 mt-2">Veuillez vous connecter pour accéder au tableau de bord</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                        <span class="text-red-700 text-sm">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ request()->is('commercial/*') ? route('commercial.login') : route('admin.login') }}">
                @csrf
                
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 accent-color"></i>Adresse email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                        placeholder="admin@example.com"
                        value="{{ old('email') }}"
                    >
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key mr-2 accent-color"></i>Mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors pr-12"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600"
                            onclick="togglePassword()"
                        >
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <button 
                        type="submit" 
                        class="w-full gradient-bg text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 transition-opacity duration-200 flex items-center justify-center"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Se connecter
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('landing.index') }}" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Retour au site
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                &copy; 2024 Africa Business Card. Tous droits réservés.
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add enter key support
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('form').submit();
            }
        });
    </script>
</body>
</html>