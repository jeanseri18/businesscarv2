@extends('admin.layouts.app')

@section('title', 'Paiements')
@section('page_title', 'Gestion des paiements')
@section('page_subtitle', 'Liste de tous les paiements effectués')

@section('content')
    <div class="bg-white rounded-xl shadow-sm">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-money-bill-wave mr-2 accent-color"></i>
                        Liste des paiements
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Total: {{ $payments->total() }} paiements</p>
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
                        <option value="">Tous les statuts</option>
                        <option value="completed">Complété</option>
                        <option value="pending">En attente</option>
                        <option value="failed">Échoué</option>
                        <option value="refunded">Remboursé</option>
                    </select>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Toutes les méthodes</option>
                        <option value="credit_card">Carte de crédit</option>
                        <option value="bank_transfer">Virement bancaire</option>
                        <option value="mobile_money">Mobile Money</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Payments Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Transaction
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Méthode
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
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
                    @forelse($payments as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $payment->transaction_id }}</div>
                                <div class="text-sm text-gray-500">ID: {{ $payment->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $payment->subscription->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $payment->subscription->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($payment->amount, 2, ',', ' ') }} {{ $payment->currency }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $payment->subscription->type }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-{{ $payment->getPaymentMethodIcon() }} text-gray-600 mr-2"></i>
                                    <div>
                                        <div class="text-sm text-gray-900">{{ $payment->getPaymentMethodLabel() }}</div>
                                        <div class="text-sm text-gray-500">{{ $payment->payment_method }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $payment->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($payment->status === 'completed') bg-green-100 text-green-800
                                    @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($payment->status === 'failed') bg-red-100 text-red-800
                                    @elseif($payment->status === 'refunded') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    <i class="fas fa-{{ $payment->getStatusIcon() }} mr-1"></i>
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                            title="Voir les détails"
                                            onclick="showPaymentDetails({{ $payment->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($payment->status === 'completed')
                                        <button class="text-orange-600 hover:text-orange-900 p-2 rounded-lg hover:bg-orange-50 transition-colors"
                                                title="Rembourser"
                                                onclick="return confirmRefund('Êtes-vous sûr de vouloir rembourser ce paiement ?')">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    @endif
                                    @if($payment->status === 'pending')
                                        <button class="text-green-600 hover:text-green-900 p-2 rounded-lg hover:bg-green-50 transition-colors"
                                                title="Marquer comme complété">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                    <button class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                            title="Supprimer"
                                            onclick="return confirmDelete('Êtes-vous sûr de vouloir supprimer ce paiement ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <i class="fas fa-money-bill-wave text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500">Aucun paiement trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Summary Cards -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg">
                    <div class="text-sm text-gray-600">Total reçu</div>
                    <div class="text-2xl font-bold text-green-600">
                        {{ number_format($totalReceived, 2, ',', ' ') }} FCFA
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg">
                    <div class="text-sm text-gray-600">En attente</div>
                    <div class="text-2xl font-bold text-yellow-600">
                        {{ number_format($totalPending, 2, ',', ' ') }} FCFA
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg">
                    <div class="text-sm text-gray-600">Remboursé</div>
                    <div class="text-2xl font-bold text-blue-600">
                        {{ number_format($totalRefunded, 2, ',', ' ') }} FCFA
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg">
                    <div class="text-sm text-gray-600">Échoué</div>
                    <div class="text-2xl font-bold text-red-600">
                        {{ number_format($totalFailed, 2, ',', ' ') }} FCFA
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($payments->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $payments->links() }}
            </div>
        @endif
    </div>

    <!-- Payment Details Modal -->
    <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-receipt mr-2 accent-color"></i>
                            Détails du paiement
                        </h3>
                        <button onclick="closePaymentModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <div id="paymentDetails" class="p-6">
                    <!-- Payment details will be loaded here -->
                </div>
            </div>
        </div>
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

    function showPaymentDetails(paymentId) {
        // Load payment details via AJAX
        fetch(`/admin/payments/${paymentId}/details`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('paymentDetails').innerHTML = `
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">ID de transaction</label>
                                <p class="text-gray-900">${data.transaction_id}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Montant</label>
                                <p class="text-gray-900 font-bold">${data.amount} ${data.currency}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Méthode de paiement</label>
                                <p class="text-gray-900">${data.payment_method}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Statut</label>
                                <p class="text-gray-900">${data.status}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Client</label>
                                <p class="text-gray-900">${data.customer_name}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Date</label>
                                <p class="text-gray-900">${data.created_at}</p>
                            </div>
                        </div>
                        ${data.description ? `
                        <div>
                            <label class="text-sm font-medium text-gray-700">Description</label>
                            <p class="text-gray-900">${data.description}</p>
                        </div>
                        ` : ''}
                    </div>
                `;
                document.getElementById('paymentModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error loading payment details:', error);
                alert('Erreur lors du chargement des détails du paiement');
            });
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').classList.add('hidden');
    }

    function confirmDelete(message) {
        return confirm(message);
    }

    function confirmRefund(message) {
        return confirm(message);
    }
</script>
@endpush