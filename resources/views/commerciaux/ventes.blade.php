@extends('commerciaux.layouts.app')

@section('title', 'Liste des Ventes')
@section('page_title', 'Liste des Ventes')
@section('page_subtitle', 'Historique de toutes vos ventes')

@section('content')
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('commercial.ventes') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Client, produit ou service...">
                </div>
                <div class="min-w-[150px]">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les types</option>
                        <option value="produit" {{ request('type') == 'produit' ? 'selected' : '' }}>Produit</option>
                        <option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Service</option>
                    </select>
                </div>
                <div class="min-w-[150px]">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="confirme" {{ request('status') == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                        <option value="livre" {{ request('status') == 'livre' ? 'selected' : '' }}>Livré</option>
                        <option value="annule" {{ request('status') == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                </div>
                <div class="min-w-[150px]">
                    <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date début</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ request('date_debut') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                    <a href="{{ route('commercial.ventes') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        <i class="fas fa-times mr-2"></i>Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-shopping-cart mr-2 accent-color"></i>
                    Liste des Ventes
                </h3>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        Ventes: {{ $ventes->total() }}
                    </span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Produit/Service
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantité
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prix Unitaire
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($ventes as $vente)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $vente->produitService->nom ?? 'Produit' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $vente->produitService->categorie ?? 'Non catégorisé' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-2">
                                        <i class="fas fa-user text-gray-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $vente->user->name ?? 'Client' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $vente->user->email ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $vente->quantite }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ number_format($vente->produitService->prix ?? 0, 0, ',', ' ') }} FCFA
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($vente->quantite * ($vente->produitService->prix ?? 0), 0, ',', ' ') }} FCFA
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($vente->statut === 'confirme') bg-green-100 text-green-800
                                    @elseif($vente->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                    @elseif($vente->statut === 'livre') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $vente->statut ?: 'en attente')) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $vente->created_at->format('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $vente->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('commercial.ventes.details', $vente) }}" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center">
                                <i class="fas fa-shopping-cart text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500 text-lg">Aucune vente trouvée</p>
                                <p class="text-gray-400 text-sm mt-1">Vos ventes apparaîtront ici</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($ventes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $ventes->links() }}
            </div>
        @endif
    </div>
@endsection