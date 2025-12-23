@extends('commerciaux.layouts.app')

@section('title', 'Mes Commissions')
@section('page_title', 'Mes Commissions')
@section('page_subtitle', 'Historique de vos commissions')

@section('content')
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('commercial.commissions') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Nom du client ou type d'abonnement...">
                </div>
                <div class="min-w-[150px]">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les statuts</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Payée</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>
                <div class="min-w-[150px]">
                    <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date début</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ request('date_debut') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="min-w-[150px]">
                    <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">Date fin</label>
                    <input type="date" name="date_fin" id="date_fin" value="{{ request('date_fin') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                </div>
                <div class="flex items-end">
                    <a href="{{ route('commercial.commissions') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
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
                    <i class="fas fa-money-bill-wave mr-2 accent-color"></i>
                    Historique des Commissions
                </h3>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        Total: {{ $commissions->total() }} commissions
                    </span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type & Montant
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Commission
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($commissions as $commission)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                    {{ $commission->achat->user->name ?? 'Client' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $commission->achat->user->email ?? '' }}
                                </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">
                                    {{ $commission->produitService->nom ?? 'Produit' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ number_format($commission->achat->quantite * ($commission->produitService->prix ?? 0), 0, ',', ' ') }} FCFA
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($commission->montant, 0, ',', ' ') }} FCFA
                                </div>
                                <div class="text-xs text-gray-500">
                                    Commission
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($commission->statut === 'completed') bg-green-100 text-green-800
                                    @elseif($commission->statut === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($commission->statut) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $commission->created_at->format('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $commission->created_at->format('H:i') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <i class="fas fa-money-bill-wave text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500 text-lg">Aucune commission trouvée</p>
                                <p class="text-gray-400 text-sm mt-1">Vos commissions apparaîtront ici</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($commissions->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $commissions->links() }}
            </div>
        @endif
    </div>
@endsection