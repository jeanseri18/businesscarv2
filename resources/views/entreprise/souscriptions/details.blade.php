@extends('entreprise.layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-info-circle mr-2 accent-color"></i>
                        Détails de la souscription
                    </h3>
                    <a href="{{ route('entreprise.souscriptions') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations générales -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Informations générales</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ID</label>
                                <p class="text-sm text-gray-900">#{{ $souscription->id }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Statut</label>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($souscription->status === 'active') bg-green-100 text-green-800
                                    @elseif($souscription->status === 'expired') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($souscription->status) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date de début</label>
                                <p class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($souscription->start_date)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date de fin</label>
                                <p class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($souscription->end_date)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informations de paiement -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Informations de paiement</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Montant</label>
                                <p class="text-sm text-gray-900">{{ number_format($souscription->amount ?? 0, 2) }} F CFA</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Devise</label>
                                <p class="text-sm text-gray-900">{{ $souscription->currency ?? 'EUR' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Méthode de paiement</label>
                                <p class="text-sm text-gray-900">{{ ucfirst($souscription->payment_method ?? 'Non spécifié') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date de paiement</label>
                                <p class="text-sm text-gray-900">{{ $souscription->payment_date ? \Carbon\Carbon::parse($souscription->payment_date)->format('d/m/Y H:i') : 'Non payé' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informations de l'utilisateur -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Informations de l'utilisateur</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nom</label>
                                <p class="text-sm text-gray-900">{{ $souscription->user->name ?? 'Utilisateur supprimé' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="text-sm text-gray-900">{{ $souscription->user->email ?? 'Non disponible' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <p class="text-sm text-gray-900">{{ $souscription->user->phone ?? 'Non spécifié' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informations de l'offre -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Informations de l'offre</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Formule</label>
                                <p class="text-sm text-gray-900">{{ $souscription->subscriptionForm->nom ?? 'Formule supprimée' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type</label>
                                <p class="text-sm text-gray-900">{{ ucfirst($souscription->subscriptionForm->type ?? 'Non spécifié') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Historique des statuts -->
                @if(isset($historiqueStatuts) && $historiqueStatuts->count() > 0)
                    <div class="mt-8">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Historique des statuts</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarques</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($historiqueStatuts as $statut)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($statut->status === 'active') bg-green-100 text-green-800
                                                    @elseif($statut->status === 'expired') bg-red-100 text-red-800
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    {{ ucfirst($statut->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($statut->created_at)->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $statut->remarks ?? 'Aucune remarque' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection