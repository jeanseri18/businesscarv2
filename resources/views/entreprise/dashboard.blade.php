@extends('entreprise.layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tableau de bord Entreprise</h3>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Offres -->
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Offres</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalOffres ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tags text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <i class="fas fa-chart-line text-blue-500 mr-1"></i>
                            <span class="text-blue-500 font-medium">Vos offres</span>
                            <span class="text-gray-600 ml-1">actives</span>
                        </div>
                    </div>
                    
                    <!-- Souscriptions Actives -->
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Souscriptions Actives</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $souscriptionsActives ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <i class="fas fa-users text-green-500 mr-1"></i>
                            <span class="text-green-500 font-medium">Abonnés</span>
                            <span class="text-gray-600 ml-1">actifs</span>
                        </div>
                    </div>
                    
                    <!-- Revenus -->
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Revenus Total</p>
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($revenusTotal ?? 0, 2) }} F CFA</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-money-bill-wave text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <i class="fas fa-coins text-purple-500 mr-1"></i>
                            <span class="text-purple-500 font-medium">Total</span>
                            <span class="text-gray-600 ml-1">des revenus</span>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Offers -->
                <div class="bg-white rounded-xl shadow-sm mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <i class="fas fa-tags mr-2 accent-color"></i>
                                Vos dernières offres
                            </h3>
                            <a href="{{ route('entreprise.offres') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                Voir tout <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        @if(isset($dernieresOffres) && $dernieresOffres->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($dernieresOffres as $offre)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $offre->nom }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($offre->prix, 2) }} F CFA</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($offre->type) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Actif
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-tags text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500">Aucune offre créée pour le moment.</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Actions rapides -->
                <div class="flex space-x-4">
                    <a href="{{ route('entreprise.offres.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i> Créer une offre
                    </a>
                    <a href="{{ route('entreprise.offres') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-list mr-2"></i> Voir toutes les offres
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection