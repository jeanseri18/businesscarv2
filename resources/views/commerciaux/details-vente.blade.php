@extends('commerciaux.layouts.app')

@section('title', 'Détails de la Vente')
@section('page_title', 'Détails de la Vente')
@section('page_subtitle', 'Informations détaillées sur la vente')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informations principales -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-shopping-cart mr-2 accent-color"></i>
                    Informations de la vente
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Produit/Service</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $vente->produitService->nom ?? 'Produit' }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $vente->produitService->description ?? '' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Catégorie</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $vente->produitService->categorie ?? 'Non définie' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Quantité</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $vente->quantite }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Prix unitaire</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ number_format($vente->produitService->prix ?? 0, 0, ',', ' ') }} FCFA</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Total HT</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ number_format($vente->quantite * ($vente->produitService->prix ?? 0), 0, ',', ' ') }} FCFA</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Statut</h4>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($vente->statut === 'confirme') bg-green-100 text-green-800
                            @elseif($vente->statut === 'en_attente') bg-yellow-100 text-yellow-800
                            @elseif($vente->statut === 'livre') bg-blue-100 text-blue-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $vente->statut ?: 'en attente')) }}
                        </span>
                    </div>
                </div>
                
                @if($vente->notes)
                    <div class="mt-6">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Notes</h4>
                        <p class="text-gray-900">{{ $vente->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Commissions -->
            @if($vente->commissions->count() > 0)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-money-bill-wave mr-2 accent-color"></i>
                        Commissions sur cette vente
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($vente->commissions as $commission)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">Commission #{{ $commission->id }}</p>
                                    <p class="text-sm text-gray-500">{{ $commission->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">{{ number_format($commission->montant, 0, ',', ' ') }} FCFA</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($commission->statut === 'completed') bg-green-100 text-green-800
                                        @elseif($commission->statut === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($commission->statut) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Informations client -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-user mr-2 accent-color"></i>
                    Informations client
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Nom</h4>
                        <p class="text-gray-900">{{ $vente->user->name ?? 'Client' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Email</h4>
                        <p class="text-gray-900">{{ $vente->user->email ?? 'Non disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Téléphone</h4>
                        <p class="text-gray-900">{{ $vente->user->phone ?? 'Non disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Date d'inscription</h4>
                        <p class="text-gray-900">{{ $vente->user->created_at->format('d/m/Y') ?? 'Non disponible' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-calendar mr-2 accent-color"></i>
                    Dates importantes
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Date de vente</h4>
                        <p class="text-gray-900">{{ $vente->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    @if($vente->updated_at != $vente->created_at)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Dernière modification</h4>
                            <p class="text-gray-900">{{ $vente->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('commercial.ventes') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour aux ventes
        </a>
        
        <div class="space-x-3">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-download mr-2"></i>
                Télécharger la facture
            </button>
        </div>
    </div>
@endsection