@extends('commerciaux.layouts.app')

@section('title', 'Changer Mot de passe')
@section('page_title', 'Changer mon mot de passe')
@section('page_subtitle', 'Mettez à jour votre mot de passe pour sécuriser votre compte')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('commerciaux.profile.password') }}">
            @csrf
            @method('PUT')

            <!-- Mot de passe actuel -->
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">
                    Mot de passe actuel
                </label>
                <input type="password" name="current_password" id="current_password" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nouveau mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Nouveau mot de passe
                </label>
                <input type="password" name="password" id="password" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
                <p class="mt-1 text-sm text-gray-500">
                    Minimum 8 caractères, incluant une majuscule, une minuscule et un chiffre
                </p>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation du nouveau mot de passe -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                    Confirmer le nouveau mot de passe
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
            </div>

            <!-- Bouton de soumission -->
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('commerciaux.dashboard') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times mr-2"></i>Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 gradient-bg text-white rounded-md hover:opacity-90 transition-all">
                    <i class="fas fa-key mr-2"></i>Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection