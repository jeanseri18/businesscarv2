@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('page_title', 'Tableau de bord')
@section('page_subtitle', 'Vue d\'ensemble de la plateforme')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Utilisateurs</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                <span class="text-green-500 font-medium">Actifs</span>
                <span class="text-gray-600 ml-1">sur la plateforme</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Souscriptions</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_subscriptions']) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-credit-card text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-clock text-orange-500 mr-1"></i>
                <span class="text-orange-500 font-medium">{{ $stats['pending_subscriptions'] }}</span>
                <span class="text-gray-600 ml-1">en attente</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Paiements</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_payments']) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-check-circle text-green-500 mr-1"></i>
                <span class="text-green-500 font-medium">{{ $stats['completed_payments'] }}</span>
                <span class="text-gray-600 ml-1">complétés</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Achats</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_achats']) }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-chart-line text-purple-500 mr-1"></i>
                <span class="text-purple-500 font-medium">Total</span>
                <span class="text-gray-600 ml-1">commandes</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-users mr-2 accent-color"></i>
                        Utilisateurs récents
                    </h3>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Voir tout <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($stats['recent_users']->count() > 0)
                    <div class="space-y-4">
                        @foreach($stats['recent_users'] as $user)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($user->role === 'admin') bg-red-100 text-red-800
                                        @elseif($user->role === 'entreprise') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800
                                        @endif">
                                        {{ ucfirst($user->role ?: 'utilisateur') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-users text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Aucun utilisateur récent</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Subscriptions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-credit-card mr-2 accent-color"></i>
                        Souscriptions récentes
                    </h3>
                    <a href="{{ route('admin.subscriptions.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Voir tout <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($stats['recent_subscriptions']->count() > 0)
                    <div class="space-y-4">
                        @foreach($stats['recent_subscriptions'] as $subscription)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-credit-card text-yellow-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ ucfirst($subscription->type) }} - {{ $subscription->sector }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $subscription->user->name }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($subscription->payment_status === 'paid') bg-green-100 text-green-800
                                        @elseif($subscription->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($subscription->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-credit-card text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Aucune souscription récente</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-money-bill-wave mr-2 accent-color"></i>
                        Paiements récents
                    </h3>
                    <a href="{{ route('admin.payments.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Voir tout <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($stats['recent_payments']->count() > 0)
                    <div class="space-y-4">
                        @foreach($stats['recent_payments'] as $payment)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-money-bill-wave text-green-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ number_format($payment->amount, 0, ',', ' ') }} {{ $payment->currency }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $payment->subscription->user->name }}
                                    </p>
                                </div>
                                <div class="text-right">
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
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-money-bill-wave text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Aucun paiement récent</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-refresh dashboard every 30 seconds
    setTimeout(function() {
        location.reload();
    }, 30000);
</script>
@endpush