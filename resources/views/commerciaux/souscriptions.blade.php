@extends('commerciaux.layouts.app')

@section('title', 'Historique des Souscriptions')
@section('page_title', 'Historique des Souscriptions')
@section('page_subtitle', 'Liste de toutes vos souscriptions')

@section('content')
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('commercial.souscriptions') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Nom ou email du client...">
                </div>
                <div class="min-w-[150px]">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les types</option>
                        <option value="basic" {{ request('type') == 'basic' ? 'selected' : '' }}>Basic</option>
                        <option value="premium" {{ request('type') == 'premium' ? 'selected' : '' }}>Premium</option>
                        <option value="enterprise" {{ request('type') == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                    </select>
                </div>
                <div class="min-w-[150px]">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les statuts</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Payé</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Échoué</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                </div>
                <div class="flex items-end">
                    <a href="{{ route('commercial.souscriptions') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
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
                    <i class="fas fa-credit-card mr-2 accent-color"></i>
                    Historique des Souscriptions
                </h3>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        Total: {{ $souscriptions->total() }} souscriptions
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
                            Type & Secteur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut Paiement
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
                    @forelse($souscriptions as $souscription)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $souscription->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $souscription->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">
                                    {{ ucfirst($souscription->type) }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $souscription->sector }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($souscription->amount, 0, ',', ' ') }} {{ $souscription->currency }}
                                </div>
                                @if($souscription->commission_amount)
                                    <div class="text-xs text-green-600">
                                        Commission: {{ number_format($souscription->commission_amount, 0, ',', ' ') }} {{ $souscription->currency }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($souscription->payment_status === 'paid') bg-green-100 text-green-800
                                    @elseif($souscription->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($souscription->payment_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $souscription->created_at->format('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $souscription->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('commercial.souscriptions.details', $souscription) }}" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center">
                                <i class="fas fa-credit-card text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500 text-lg">Aucune souscription trouvée</p>
                                <p class="text-gray-400 text-sm mt-1">Vos souscriptions apparaîtront ici</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($souscriptions->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $souscriptions->links() }}
            </div>
        @endif
    </div>
@endsection