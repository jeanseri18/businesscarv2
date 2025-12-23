@extends('entreprise.layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-edit mr-2 accent-color"></i>
                        Modifier l'offre
                    </h3>
                    <a href="{{ route('entreprise.offres') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                </div>
                
                <form action="{{ route('entreprise.offres.update', $offre) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div class="md:col-span-2">
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'offre</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $offre->nom) }}" required 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border-2 transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Détail -->
                        <div class="md:col-span-2">
                            <label for="detail" class="block text-sm font-medium text-gray-700">Détail</label>
                            <textarea name="detail" id="detail" rows="4" required 
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border-2 transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('detail', $offre->detail) }}</textarea>
                            @error('detail')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Prix -->
                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700">Prix (F CFA)</label>
                            <input type="number" name="prix" id="prix" step="0.01" min="0" value="{{ old('prix', $offre->prix) }}" required 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border-2 transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            @error('prix')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select name="type" id="type" required 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border-2 transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="produit" {{ old('type', $offre->type) === 'produit' ? 'selected' : '' }}>Produit</option>
                                <option value="service" {{ old('type', $offre->type) === 'service' ? 'selected' : '' }}>Service</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Photo -->
                        <div class="md:col-span-2">
                            <label for="photo_path" class="block text-sm font-medium text-gray-700">Photo (optionnel)</label>
                            <input type="file" name="photo_path" id="photo_path" accept="image/*"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border-2 transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            @if($offre->photo_path)
                                <p class="mt-1 text-sm text-gray-500">Fichier actuel: {{ basename($offre->photo_path) }}</p>
                            @endif
                            @error('photo_path')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- PDF -->
                        <div class="md:col-span-2">
                            <label for="pdf_path" class="block text-sm font-medium text-gray-700">Fichier PDF (optionnel)</label>
                            <input type="file" name="pdf_path" id="pdf_path" accept="application/pdf"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border-2 transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            @if($offre->pdf_path)
                                <p class="mt-1 text-sm text-gray-500">Fichier actuel: {{ basename($offre->pdf_path) }}</p>
                            @endif
                            @error('pdf_path')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-4 mt-6">
                        <a href="{{ route('entreprise.offres') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">
                            Annuler
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-save mr-2"></i> Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection