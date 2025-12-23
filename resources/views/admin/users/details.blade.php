@extends('admin.layouts.app')

@section('title', 'Détails Utilisateur')
@section('page_title', 'Détails de l\'utilisateur')
@section('page_subtitle', 'Informations complètes et activités')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-gray-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h3>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2
                        @if($user->role === 'admin') bg-red-100 text-red-800
                        @elseif($user->role === 'entreprise') bg-blue-100 text-blue-800
                        @elseif($user->role === 'commercial') bg-purple-100 text-purple-800
                        @else bg-green-100 text-green-800
                        @endif">
                        {{ ucfirst($user->role ?: 'utilisateur') }}
                    </span>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-phone text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">{{ $user->phone ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-globe text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">{{ $user->country ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-flag text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">{{ $user->nationality ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">Inscrit le {{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-gray-400 w-5"></i>
                        <span class="ml-3 text-gray-900">
                            @if($user->email_verified_at)
                                Vérifié le {{ $user->email_verified_at->format('d/m/Y') }}
                            @else
                                Non vérifié
                            @endif
                        </span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex space-x-2">
                        <button class="flex-1 accent-bg text-blue-900 py-2 px-4 rounded-lg font-medium hover:bg-yellow-400 transition-colors">
                            <i class="fas fa-edit mr-1"></i>
                            Modifier
                        </button>
                        <button class="flex-1 bg-red-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-red-700 transition-colors"
                                onclick="return confirmDelete('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                            <i class="fas fa-trash mr-1"></i>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Activities and Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Subscriptions -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-credit-card mr-2 accent-color"></i>
                        Abonnements
                    </h3>
                </div>
                <div class="p-6">
                    @if($user->subscriptions->count() > 0)
                        <div class="space-y-4">
                            @foreach($user->subscriptions as $subscription)
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

            <!-- Business Cards -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-id-card mr-2 accent-color"></i>
                        Cartes de visite
                    </h3>
                </div>
                <div class="p-6">
                    @if($user->businessCards->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($user->businessCards as $card)
                                <div class="p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center mb-3">
                                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-building text-gray-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $card->company_name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $card->job_title }}</p>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <p><i class="fas fa-envelope mr-1"></i> {{ $card->email }}</p>
                                        <p><i class="fas fa-phone mr-1"></i> {{ $card->phone }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-id-card text-gray-300 text-3xl mb-4"></i>
                            <p class="text-gray-500">Aucune carte de visite créée</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-history mr-2 accent-color"></i>
                        Activités récentes
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($user->auditLogs->take(5) as $log)
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-info text-gray-600 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900">{{ $log->description }}</p>
                                    <p class="text-xs text-gray-500">{{ $log->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-history text-gray-300 text-3xl mb-4"></i>
                                <p class="text-gray-500">Aucune activité récente</p>
                            </div>
                        @endforelse
                    </div>
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