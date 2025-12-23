@extends('admin.layouts.app')

@section('content')
<div class="flex-grow">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Offres et Services</h1>
        <p class="text-gray-600">Liste complète des offres et services disponibles</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Offres</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalOffres) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Ventes</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalVentes) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Revenu Total</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalRevenue, 2) }} CFA</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Offers Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Liste des Offres et Services</h2>
            <button onclick="openAchatModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Ajouter un Achat
            </button>
        </div>
        
        <div class="overflow-x-auto" style="max-width: 100%;">
            <table class="min-w-full divide-y divide-gray-200" style="max-width: 100%;">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Titre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prix
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Entreprise
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ventes
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date de création
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($offres as $offre)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $offre->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $offre->nom }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($offre->detail ?? 'Aucune description', 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($offre->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($offre->prix, 2) }} CFA
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($offre->entreprise)
                                    {{ $offre->entreprise->name }}
                                @else
                                    <span class="text-gray-400">Non assigné</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $offre->achats->count() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Disponible
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $offre->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                Aucune offre ou service trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($offres->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $offres->links() }}
            </div>
        @endif
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