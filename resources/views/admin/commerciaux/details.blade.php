@extends('admin.layouts.app')

@section('title', 'Détails du Commercial - ' . $commercial->name)
@section('page_title', 'Détails du Commercial')
@section('page_subtitle', 'Informations complètes et statistiques')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-tie text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">{{ $commercial->name }}</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 mt-2">
                        Commercial
                    </span>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">{{ $commercial->email }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">{{ $commercial->phone ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-flag text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">{{ $commercial->country ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">Inscrit le {{ $commercial->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Commission Statistics -->
            <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistiques des Commissions</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total des Commissions</p>
                            <p class="text-xl font-semibold text-gray-900">{{ number_format($totalCommissions, 2, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-green-50 rounded-lg">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Commissions Payées</p>
                            <p class="text-xl font-semibold text-gray-900">{{ number_format($paidCommissions, 2, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-yellow-50 rounded-lg">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Commissions en Attente</p>
                            <p class="text-xl font-semibold text-gray-900">{{ number_format($pendingCommissions, 2, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button class="tab-button py-4 px-1 border-b-2 border-blue-500 text-sm font-medium text-blue-600" data-tab="subscriptions">
                            Souscriptions
                        </button>
                        <button class="tab-button py-4 px-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="commissions">
                            Commissions
                        </button>
                        <button class="tab-button py-4 px-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="activity">
                            Activité
                        </button>
                    </nav>
                </div>
                <div class="p-6">
                    <!-- Subscriptions Tab -->
                    <div class="tab-content" id="subscriptions">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Secteur</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut Paiement</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Début</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Fin</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($commercial->subscriptions as $subscription)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $subscription->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ ucfirst($subscription->type) }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $subscription->sector }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($subscription->price, 2, ',', ' ') }} FCFA</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($subscription->payment_status === 'paid')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Payé</span>
                                            @elseif($subscription->payment_status === 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">En attente</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Échoué</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $subscription->start_date->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $subscription->end_date->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.subscriptions.details', $subscription) }}" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">Aucune souscription trouvée</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Commissions Tab -->
                    <div class="tab-content hidden" id="commissions">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($commercial->commissions as $commission)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $commission->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $commission->produit->nom ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($commission->montant, 2) }} FCFA</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($commission->isPaye())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Payé</span>
                                            @elseif($commission->isAnnule())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Annulé</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">En attente</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $commission->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Aucune commission trouvée</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Activity Tab -->
                    <div class="tab-content hidden" id="activity">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Détails</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($commercial->auditLogs as $log)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $log->action }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $log->details }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Aucune activité trouvée</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    // Tab functionality
    console.log('Tab script loaded');
    
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            console.log('Tab clicked:', this.getAttribute('data-tab'));
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and hide all content
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Add active class to clicked button and show target content
            this.classList.add('border-blue-500', 'text-blue-600');
            this.classList.remove('border-transparent', 'text-gray-500');
            const targetElement = document.getElementById(targetTab);
            if (targetElement) {
                targetElement.classList.remove('hidden');
                console.log('Showing tab:', targetTab);
            } else {
                console.error('Tab element not found:', targetTab);
            }
        });
    });
</script>
@endpush
@endsection