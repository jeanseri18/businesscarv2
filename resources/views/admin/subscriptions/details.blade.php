@extends('admin.layouts.app')

@section('title', 'Détails de l\'abonnement')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Détails de l\'abonnement</h1>
        <p class="text-gray-600">Informations complètes sur l\'abonnement</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Subscription Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Informations de l\'abonnement</h2>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($subscription->status === 'active')
                            bg-green-100 text-green-800
                        @elseif($subscription->status === 'pending')
                            bg-yellow-100 text-yellow-800
                        @elseif($subscription->status === 'expired')
                            bg-red-100 text-red-800
                        @else
                            bg-gray-100 text-gray-800
                        @endif
                    ">
                        {{ ucfirst($subscription->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type d\'abonnement</label>
                        <p class="text-gray-900">{{ ucfirst($subscription->type) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix</label>
                        <p class="text-gray-900">{{ number_format($subscription->price, 2, ',', ' ') }} {{ $subscription->currency ?? 'EUR' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                        <p class="text-gray-900">{{ $subscription->start_date ? $subscription->start_date->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date d\'expiration</label>
                        <p class="text-gray-900">{{ $subscription->end_date ? $subscription->end_date->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Durée (mois)</label>
                        <p class="text-gray-900">{{ $subscription->duration ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de création</label>
                        <p class="text-gray-900">{{ $subscription->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Informations de l\'utilisateur</h2>
                @if($subscription->user)
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold">{{ strtoupper(substr($subscription->user->name, 0, 2)) }}</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $subscription->user->name }}</h3>
                            <p class="text-gray-600">{{ $subscription->user->email }}</p>
                            <p class="text-gray-600">{{ $subscription->user->phone ?? 'Pas de téléphone' }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.users.details', $subscription->user) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-user mr-2"></i>
                            Voir le profil
                        </a>
                    </div>
                @else
                    <p class="text-gray-600">Aucun utilisateur associé</p>
                @endif
            </div>

            <!-- Payments -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Historique des paiements</h2>
                @if($subscription->payments->count() > 0)
                    <div class="space-y-4">
                        @foreach($subscription->payments as $payment)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $payment->formatted_amount }}</p>
                                        <p class="text-sm text-gray-600">{{ $payment->payment_method_label }}</p>
                                        <p class="text-sm text-gray-600">{{ $payment->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($payment->status === 'completed')
                                            bg-green-100 text-green-800
                                        @elseif($payment->status === 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @elseif($payment->status === 'failed')
                                            bg-red-100 text-red-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif
                                    ">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">Aucun paiement trouvé</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
                <div class="space-y-3">
                    <button onclick="updateSubscriptionStatus('active')" 
                            class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        <i class="fas fa-check mr-2"></i>
                        Activer
                    </button>
                    <button onclick="updateSubscriptionStatus('pending')" 
                            class="w-full px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition-colors">
                        <i class="fas fa-clock mr-2"></i>
                        Mettre en attente
                    </button>
                    <button onclick="updateSubscriptionStatus('expired')" 
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Expirer
                    </button>
                    <button onclick="updateSubscriptionStatus('cancelled')" 
                            class="w-full px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                        <i class="fas fa-ban mr-2"></i>
                        Annuler
                    </button>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistiques</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total des paiements</span>
                        <span class="font-medium">{{ $subscription->payments->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Montant total payé</span>
                        <span class="font-medium">{{ number_format($subscription->payments->where('status', 'completed')->sum('amount'), 2, ',', ' ') }} {{ $subscription->currency ?? 'EUR' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Documents</span>
                        <span class="font-medium">{{ $subscription->enterpriseDocuments->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Cartes d\'affaires</span>
                        <span class="font-medium">{{ $subscription->businessCards->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateSubscriptionStatus(status) {
    if (confirm('Êtes-vous sûr de vouloir changer le statut de cet abonnement ?')) {
        fetch('{{ route("admin.subscriptions.update-status", $subscription) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de la mise à jour du statut');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur lors de la mise à jour du statut');
        });
    }
}
</script>
@endsection