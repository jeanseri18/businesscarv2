@extends('admin.layouts.app')

@section('title', 'Détails Entreprise')
@section('page_title', 'Détails de l\'entreprise')
@section('page_subtitle', 'Informations complètes et offres')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Enterprise Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-gray-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">{{ $enterprise->company_name }}</h3>
                    <p class="text-gray-600">{{ $enterprise->sector }} - {{ $enterprise->activity }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2
                        @if($enterprise->status === 'active') bg-green-100 text-green-800
                        @elseif($enterprise->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($enterprise->status === 'suspended') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($enterprise->status ?: 'en attente') }}
                    </span>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-gray-400 w-5 mt-1"></i>
                        <span class="ml-3 text-gray-900">
                            {{ $enterprise->address }}<br>
                            {{ $enterprise->city }}, {{ $enterprise->country }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">{{ $enterprise->phone ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">{{ $enterprise->email }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-globe text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">
                            @if($enterprise->website)
                                <a href="{{ $enterprise->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $enterprise->website }}
                                </a>
                            @else
                                Non renseigné
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">Inscrit le {{ $enterprise->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="font-medium text-gray-900 mb-3">Représentant légal</h4>
                    <div class="space-y-2 text-sm">
                        <p><strong>Nom:</strong> {{ $enterprise->legal_representative }}</p>
                        <p><strong>Email:</strong> {{ $enterprise->legal_representative_email }}</p>
                        <p><strong>Téléphone:</strong> {{ $enterprise->legal_representative_phone }}</p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex space-x-2">
                        <button class="flex-1 accent-bg text-blue-900 py-2 px-4 rounded-lg font-medium hover:bg-yellow-400 transition-colors">
                            <i class="fas fa-edit mr-1"></i>
                            Modifier
                        </button>
                        <button class="flex-1 bg-red-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-red-700 transition-colors"
                                onclick="return confirmDelete('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">
                            <i class="fas fa-trash mr-1"></i>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enterprise Details and Offers -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Enterprise Documents -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-file-alt mr-2 accent-color"></i>
                        Documents de l'entreprise
                    </h3>
                </div>
                <div class="p-6">
                    @if($enterprise->documents->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($enterprise->documents as $document)
                                <div class="p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-file text-gray-600 mr-2"></i>
                                        <h4 class="font-medium text-gray-900">{{ ucfirst($document->document_type) }}</h4>
                                    </div>
                                    <div class="text-sm text-gray-600 mb-3">
                                        <p><strong>Statut:</strong> 
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                @if($document->status === 'approved') bg-green-100 text-green-800
                                                @elseif($document->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($document->status === 'rejected') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($document->status) }}
                                            </span>
                                        </p>
                                        <p><strong>Date de soumission:</strong> {{ $document->created_at->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm">
                                            <i class="fas fa-eye mr-1"></i>
                                            Voir
                                        </button>
                                        <button class="text-green-600 hover:text-green-800 text-sm">
                                            <i class="fas fa-check mr-1"></i>
                                            Approuver
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 text-sm">
                                            <i class="fas fa-times mr-1"></i>
                                            Rejeter
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-file-alt text-gray-300 text-3xl mb-4"></i>
                            <p class="text-gray-500">Aucun document soumis</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Offers and Services -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-briefcase mr-2 accent-color"></i>
                            Offres et services
                        </h3>
                        <button class="accent-bg text-blue-900 px-3 py-1 rounded-lg text-sm font-medium hover:bg-yellow-400 transition-colors">
                            <i class="fas fa-plus mr-1"></i>
                            Ajouter une offre
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    @if($enterprise->offresEtServices->count() > 0)
                        <div class="space-y-4">
                            @foreach($enterprise->offresEtServices as $offer)
                                <div class="p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900">{{ $offer->title }}</h4>
                                            <p class="text-sm text-gray-600">{{ $offer->category }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($offer->status === 'active') bg-green-100 text-green-800
                                            @elseif($offer->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($offer->status === 'inactive') bg-gray-100 text-gray-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($offer->status) }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 mb-3">{{ Str::limit($offer->description, 150) }}</p>
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="text-gray-600">
                                            <i class="fas fa-calendar mr-1"></i>
                                            Créé le {{ $offer->created_at->format('d/m/Y') }}
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye mr-1"></i>
                                                Voir
                                            </button>
                                            <button class="text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-edit mr-1"></i>
                                                Modifier
                                            </button>
                                            <button class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash mr-1"></i>
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-briefcase text-gray-300 text-3xl mb-4"></i>
                            <p class="text-gray-500">Aucune offre ou service proposé</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Subscriptions -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-credit-card mr-2 accent-color"></i>
                        Abonnements de l'entreprise
                    </h3>
                </div>
                <div class="p-6">
                    @if($enterprise->user && $enterprise->user->subscriptions->count() > 0)
                        <div class="space-y-4">
                            @foreach($enterprise->user->subscriptions as $subscription)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $subscription->type }}</h4>
                                        <p class="text-sm text-gray-600">Expire le {{ $subscription->expires_at->format('d/m/Y') }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($subscription->status === 'active') bg-green-100 text-green-800
                                        @elseif($subscription->status === 'expired') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($subscription->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-credit-card text-gray-300 text-3xl mb-4"></i>
                            <p class="text-gray-500">Aucun abonnement actif</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function confirmDelete(message) {
        return confirm(message);
    }
</script>
@endpush