@extends('commerciaux.layouts.app')

@section('title', 'Détails de la Souscription')
@section('page_title', 'Détails de la Souscription')
@section('page_subtitle', 'Informations détaillées sur la souscription')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informations principales -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-credit-card mr-2 accent-color"></i>
                    Informations de la souscription
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Type</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ ucfirst($souscription->type) }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Secteur</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $souscription->sector }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Montant</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ number_format($souscription->amount, 0, ',', ' ') }} {{ $souscription->currency }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Statut Paiement</h4>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($souscription->payment_status === 'paid') bg-green-100 text-green-800
                            @elseif($souscription->payment_status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($souscription->payment_status) }}
                        </span>
                    </div>
                    
                    @if($souscription->commission_amount)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Commission</h4>
                            <p class="text-lg font-semibold text-green-600">{{ number_format($souscription->commission_amount, 0, ',', ' ') }} {{ $souscription->currency }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Date d'expiration</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $souscription->expires_at ? $souscription->expires_at->format('d/m/Y') : 'Non définie' }}</p>
                    </div>
                </div>
            </div>

            <!-- Paiements -->
            @if($souscription->payments->count() > 0)
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-money-bill-wave mr-2 accent-color"></i>
                        Historique des paiements
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($souscription->payments as $payment)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">Paiement #{{ $payment->id }}</p>
                                    <p class="text-sm text-gray-500">{{ $payment->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">{{ number_format($payment->amount, 0, ',', ' ') }} {{ $payment->currency }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($payment->status === 'completed') bg-green-100 text-green-800
                                        @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($payment->status === 'failed') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Documents d'entreprise -->
            @if($souscription->enterpriseDocuments->count() > 0)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-file-alt mr-2 accent-color"></i>
                        Documents d'entreprise
                    </h3>
                    
                    <div class="space-y-3">
                        @foreach($souscription->enterpriseDocuments as $document)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center mr-3">
                                        <i class="fas fa-file text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $document->type)) }}</p>
                                        <p class="text-xs text-gray-500">{{ $document->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <button class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-download mr-1"></i>
                                    Télécharger
                                </button>
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
                        <p class="text-gray-900">{{ $souscription->user->name }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Email</h4>
                        <p class="text-gray-900">{{ $souscription->user->email }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Téléphone</h4>
                        <p class="text-gray-900">{{ $souscription->user->phone ?? 'Non disponible' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Entreprise</h4>
                        <p class="text-gray-900">{{ $souscription->user->company_name ?? 'Non définie' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Date d'inscription</h4>
                        <p class="text-gray-900">{{ $souscription->user->created_at->format('d/m/Y') }}</p>
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
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Date de souscription</h4>
                        <p class="text-gray-900">{{ $souscription->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    @if($souscription->updated_at != $souscription->created_at)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Dernière modification</h4>
                            <p class="text-gray-900">{{ $souscription->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('commercial.souscriptions') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour aux souscriptions
        </a>
        
        <div class="space-x-3">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-download mr-2"></i>
                Télécharger la facture
            </button>
        </div>
    </div>
@endsection