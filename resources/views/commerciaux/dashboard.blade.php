@extends('commerciaux.layouts.app')

@section('title', 'Tableau de bord Commercial')
@section('page_title', 'Tableau de bord')
@section('page_subtitle', 'Vue d\'ensemble de vos performances')

@section('content')
    <!-- Période Selector -->
    <div class="mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('commercial.dashboard', ['periode' => 'semaine']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ $periode == 'semaine' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                Cette semaine
            </a>
            <a href="{{ route('commercial.dashboard', ['periode' => 'mois']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ $periode == 'mois' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                Ce mois
            </a>
            <a href="{{ route('commercial.dashboard', ['periode' => 'trimestre']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ $periode == 'trimestre' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                Ce trimestre
            </a>
            <a href="{{ route('commercial.dashboard', ['periode' => 'annee']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ $periode == 'annee' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                Cette année
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Ventes</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalVentes, 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-chart-line text-blue-500 mr-1"></i>
                <span class="text-blue-500 font-medium">Vos ventes</span>
                <span class="text-gray-600 ml-1">sur la période</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Ventes Confirmées</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($ventesConfirmees) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-chart-bar text-green-500 mr-1"></i>
                <span class="text-green-500 font-medium">Confirmées</span>
                <span class="text-gray-600 ml-1">sur la période</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Commissions Totales</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalCommissions, 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-wallet text-purple-500 mr-1"></i>
                <span class="text-purple-500 font-medium">Payées</span>
                <span class="text-gray-600 ml-1">sur la période</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Taux de Conversion</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $tauxConversion }}%</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-percentage text-orange-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-chart-pie text-orange-500 mr-1"></i>
                <span class="text-orange-500 font-medium">Performance</span>
                <span class="text-gray-600 ml-1">globale</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Ventes -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-shopping-cart mr-2 accent-color"></i>
                        Ventes récentes
                    </h3>
                    <a href="{{ route('commercial.ventes') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Voir tout <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($ventesRecentes->count() > 0)
                    <div class="space-y-4">
                        @foreach($ventesRecentes as $vente)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-shopping-cart text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $vente->produitService->nom ?? 'Produit' }}</p>
                                    <p class="text-xs text-gray-500">{{ $vente->user->name ?? 'Client' }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($vente->statut === 'confirme') bg-green-100 text-green-800
                                        @elseif($vente->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($vente->statut ?: 'en attente') }}
                                    </span>
                                    <p class="text-xs text-gray-600 mt-1">{{ number_format($vente->quantite * ($vente->produitService->prix ?? 0), 0, ',', ' ') }} FCFA</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-shopping-cart text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Aucune vente récente</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Commissions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-money-bill-wave mr-2 accent-color"></i>
                        Commissions récentes
                    </h3>
                    <a href="{{ route('commercial.souscriptions') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Voir tout <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($commissionsRecentes->count() > 0)
                    <div class="space-y-4">
                        @foreach($commissionsRecentes as $commission)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-money-bill-wave text-green-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ number_format($commission->amount ?? 0, 0, ',', ' ') }} FCFA</p>
                                    <p class="text-xs text-gray-500">{{ $commission->subscription->user->name ?? 'Client' }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($commission->status === 'completed') bg-green-100 text-green-800
                                        @elseif($commission->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($commission->status ?: 'en attente') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-money-bill-wave text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Aucune commission récente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection