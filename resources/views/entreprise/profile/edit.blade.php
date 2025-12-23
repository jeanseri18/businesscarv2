@extends('entreprise.layouts.app')

@section('title', 'Modifier Profil')
@section('page_title', 'Modifier mon profil')
@section('page_subtitle', 'Mettez à jour vos informations personnelles')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('entreprise.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informations personnelles -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations personnelles</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                        <input type="text" name="country" id="country" value="{{ old('country', Auth::user()->country ?? '') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-700 mb-1">Nationalité</label>
                        <input type="text" name="nationality" id="nationality" value="{{ old('nationality', Auth::user()->nationality ?? '') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
                        @error('nationality')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Photo de profil</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border-2 transition-all duration-300 focus:ring-2 focus:ring-blue-200">
                        @error('avatar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('entreprise.dashboard') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times mr-2"></i>Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 gradient-bg text-white rounded-md hover:opacity-90 transition-all">
                    <i class="fas fa-save mr-2"></i>Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection