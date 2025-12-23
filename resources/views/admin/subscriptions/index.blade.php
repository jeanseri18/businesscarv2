@extends('admin.layouts.app')

@section('title', 'Abonnements')
@section('page_title', 'Gestion des abonnements')
@section('page_subtitle', 'Liste de tous les abonnements actifs et expirés')

@section('content')
    <div class="bg-white rounded-xl shadow-sm">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-credit-card mr-2 accent-color"></i>
                        Liste des abonnements
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Total: {{ $subscriptions->total() }} abonnements</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <input 
                            type="text" 
                            id="searchInput" 
                            placeholder="Rechercher..." 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tous les types</option>
                        <option value="junior">Junior</option>
                        <option value="senior">Senior</option>
                        <option value="manager">Manager</option>
                        <option value="enterprise">Enterprise</option>
                    </select>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tous les statuts</option>
                        <option value="active">Actif</option>
                        <option value="expired">Expiré</option>
                        <option value="pending">En attente</option>
                    </select>
                    <button class="accent-bg text-blue-900 px-4 py-2 rounded-lg font-medium hover:bg-yellow-400 transition-colors">
                        <i class="fas fa-plus mr-1"></i>
                        Ajouter
                    </button>
                </div>
            </div>
        </div>

        <!-- Subscriptions Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Utilisateur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type d'abonnement
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prix
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date de début
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date d'expiration
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($subscriptions as $subscription)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $subscription->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $subscription->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-crown text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ ucfirst($subscription->type) }}</div>
                                        <div class="text-sm text-gray-500">{{ $subscription->duration_months }} mois</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($subscription->price, 2, ',', ' ') }} FCFA
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $subscription->start_date ? $subscription->start_date->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $subscription->end_date ? $subscription->end_date->format('d/m/Y') : 'N/A' }}
                                @if($subscription->end_date && $subscription->end_date->isPast())
                                    <span class="text-red-600 text-xs block">Expiré</span>
                                @elseif($subscription->end_date && $subscription->end_date->diffInDays() <= 7)
                                    <span class="text-yellow-600 text-xs block">Expire bientôt</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($subscription->isActive()) bg-green-100 text-green-800
                                    @elseif($subscription->isExpired()) bg-red-100 text-red-800
                                    @elseif($subscription->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    @if($subscription->isActive())
                                        Actif
                                    @elseif($subscription->isExpired())
                                        Expiré
                                    @elseif($subscription->payment_status === 'pending')
                                        En attente
                                    @else
                                        {{ ucfirst($subscription->payment_status) }}
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                            title="Renouveler">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900 p-2 rounded-lg hover:bg-green-50 transition-colors"
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                            title="Annuler"
                                            onclick="return confirmDelete('Êtes-vous sûr de vouloir annuler cet abonnement ?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <i class="fas fa-credit-card text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500">Aucun abonnement trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($subscriptions->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $subscriptions->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function confirmDelete(message) {
        return confirm(message);
    }
</script>
@endpush