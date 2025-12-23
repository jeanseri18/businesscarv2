@extends('admin.layouts.app')

@section('title', 'Achats')
@section('page_title', 'Gestion des achats')
@section('page_subtitle', 'Liste de tous les achats effectués')

@section('content')
    <div class="bg-white rounded-xl shadow-sm">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-shopping-cart mr-2 accent-color"></i>
                        Liste des achats
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Total: {{ $achats->total() }} achats</p>
                     
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
                        <option value="">Tous les types</option>
                        <option value="service">Service</option>
                        <option value="product">Produit</option>
                        <option value="subscription">Abonnement</option>
                    </select>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tous les statuts</option>
                        <option value="pending">En attente</option>
                        <option value="completed">Terminé</option>
                        <option value="cancelled">Annulé</option>
                        <option value="refunded">Remboursé</option>
                    </select>
                           <button onclick="openAchatModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Ajouter un Achat
            </button>
                </div>
            </div>
        </div>

        <!-- Purchases Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Référence
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Détails
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantité
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant
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
                    @forelse($achats as $purchase)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $purchase->reference }}</div>
                                <div class="text-sm text-gray-500">ID: {{ $purchase->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $purchase->nom }} {{ $purchase->prenom }}</div>
                                        <div class="text-sm text-gray-500">{{ $purchase->email ?? 'Email non renseigné' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($purchase->type === 'service') bg-blue-100 text-blue-800
                                    @elseif($purchase->type === 'product') bg-green-100 text-green-800
                                    @elseif($purchase->type === 'subscription') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($purchase->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    @if($purchase->offreEtService)
                                        {{ $purchase->offreEtService->title }}
                                    @else
                                        {{ $purchase->description ?? 'Aucune description' }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $purchase->quantite }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($purchase->montant_total, 2, ',', ' ') }} FCFA
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $purchase->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($purchase->statut === 'completed') bg-green-100 text-green-800
                                    @elseif($purchase->statut === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($purchase->statut === 'cancelled') bg-red-100 text-red-800
                                    @elseif($purchase->statut === 'refunded') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($purchase->statut) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                            title="Voir les détails"
                                            onclick="showPurchaseDetails({{ $purchase->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($purchase->statut === 'pending')
                                        <button class="text-green-600 hover:text-green-900 p-2 rounded-lg hover:bg-green-50 transition-colors"
                                                title="Marquer comme terminé">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                    @if($purchase->statut === 'completed')
                                        <button class="text-orange-600 hover:text-orange-900 p-2 rounded-lg hover:bg-orange-50 transition-colors"
                                                title="Rembourser"
                                                onclick="return confirmRefund('Êtes-vous sûr de vouloir rembourser cet achat ?')">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    @endif
                                    <button class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                            title="Annuler"
                                            onclick="return confirmCancel('Êtes-vous sûr de vouloir annuler cet achat ?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <i class="fas fa-shopping-cart text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500">Aucun achat trouvé</p>
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
                    <div class="text-sm text-gray-600">Total des ventes</div>
                    <div class="text-2xl font-bold text-green-600">
                        {{ number_format($totalSales, 2, ',', ' ') }} FCFA
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
                    <div class="text-sm text-gray-600">Nombre total</div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ $totalCount }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($achats->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $achats->links() }}
            </div>
        @endif
    </div>

    <!-- Purchase Details Modal -->
    <div id="purchaseModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-receipt mr-2 accent-color"></i>
                            Détails de l'achat
                        </h3>
                        <button onclick="closePurchaseModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <div id="purchaseDetails" class="p-6">
                    <!-- Purchase details will be loaded here -->
                </div>
            </div>
        </div>
    </div>

<!-- Achat Modal -->
<div id="achatModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Ajouter un Achat</h3>
                <button onclick="closeAchatModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="achatForm" class="px-6 py-4">
                @csrf
                
                <!-- Sélection du produit/service -->
                <div class="mb-4">
                    <label for="id_produit_service" class="block text-sm font-medium text-gray-700 mb-2">Produit/Service *</label>
                    <select name="id_produit_service" id="id_produit_service" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Sélectionner un produit ou service</option>
                        @foreach($offres as $offre)
                            <option value="{{ $offre->id }}" data-prix="{{ $offre->prix }}">
                                {{ $offre->nom }} - {{ number_format($offre->prix, 2) }} CFA
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Informations client -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                        <input type="text" name="nom" id="nom" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">Prénom *</label>
                        <input type="text" name="prenom" id="prenom" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp</label>
                    <input type="tel" name="whatsapp" id="whatsapp" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="code_commercial" class="block text-sm font-medium text-gray-700 mb-2">Code Commercial</label>
                    <input type="text" name="code_commercial" id="code_commercial" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrer le code commercial">
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Sélectionner le type</option>
                        <option value="produit">Produit</option>
                        <option value="service">Service</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="quantite" class="block text-sm font-medium text-gray-700 mb-2">Quantité *</label>
                    <input type="number" name="quantite" id="quantite" min="1" value="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="mb-4">
                    <label for="lieu_livraison" class="block text-sm font-medium text-gray-700 mb-2">Lieu de livraison</label>
                    <input type="text" name="lieu_livraison" id="lieu_livraison" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="date_livraison" class="block text-sm font-medium text-gray-700 mb-2">Date de livraison</label>
                    <input type="date" name="date_livraison" id="date_livraison" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" id="notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Résumé du prix -->
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700">Prix unitaire:</span>
                        <span id="prix_unitaire" class="text-sm text-gray-900">0.00 €</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-sm font-medium text-gray-700">Total:</span>
                        <span id="prix_total" class="text-lg font-semibold text-gray-900">0.00 €</span>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAchatModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer l'achat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAchatModal() {
    document.getElementById('achatModal').classList.remove('hidden');
}

function closeAchatModal() {
    document.getElementById('achatModal').classList.add('hidden');
    document.getElementById('achatForm').reset();
    updatePrixTotal();
}

function updatePrixTotal() {
    const produitSelect = document.getElementById('id_produit_service');
    const quantiteInput = document.getElementById('quantite');
    const prixUnitaireSpan = document.getElementById('prix_unitaire');
    const prixTotalSpan = document.getElementById('prix_total');
    
    if (produitSelect.value && quantiteInput.value) {
        const prixUnitaire = parseFloat(produitSelect.options[produitSelect.selectedIndex].dataset.prix);
        const quantite = parseInt(quantiteInput.value);
        const total = prixUnitaire * quantite;
        
        prixUnitaireSpan.textContent = prixUnitaire.toFixed(2) + ' €';
        prixTotalSpan.textContent = total.toFixed(2) + ' €';
    } else {
        prixUnitaireSpan.textContent = '0.00 €';
        prixTotalSpan.textContent = '0.00 €';
    }
}

// Écouteurs d'événements
document.getElementById('id_produit_service').addEventListener('change', updatePrixTotal);
document.getElementById('quantite').addEventListener('input', updatePrixTotal);

// Gestion de la soumission du formulaire
document.getElementById('achatForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("admin.achats.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Achat créé avec succès!');
            closeAchatModal();
            // Recharger la page pour afficher le nouvel achat
            window.location.reload();
        } else {
            alert('Erreur: ' + (data.message || 'Une erreur est survenue'));
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la création de l\'achat');
    });
});

// Fermer le modal en cliquant sur l'arrière-plan
document.getElementById('achatModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAchatModal();
    }
});
</script>
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

    function showPurchaseDetails(purchaseId) {
        // Load purchase details via AJAX
        fetch(`/admin/purchases/${purchaseId}/details`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('purchaseDetails').innerHTML = `
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Référence</label>
                                <p class="text-gray-900">${data.reference}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Type</label>
                                <p class="text-gray-900">${data.type}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Client</label>
                                <p class="text-gray-900">${data.nom} ${data.prenom}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Email</label>
                                <p class="text-gray-900">${data.email || 'Non renseigné'}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Quantité</label>
                                <p class="text-gray-900">${data.quantite}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Montant total</label>
                                <p class="text-gray-900 font-bold">${data.montant_total} FCFA</p>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Description</label>
                            <p class="text-gray-900">${data.description || 'Aucune description'}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Date de création</label>
                                <p class="text-gray-900">${data.created_at}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Statut</label>
                                <p class="text-gray-900">${data.statut}</p>
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('purchaseModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error loading purchase details:', error);
                alert('Erreur lors du chargement des détails de l\'achat');
            });
    }

    function closePurchaseModal() {
        document.getElementById('purchaseModal').classList.add('hidden');
    }

    function confirmCancel(message) {
        return confirm(message);
    }

    function confirmRefund(message) {
        return confirm(message);
    }
</script>
@endpush

