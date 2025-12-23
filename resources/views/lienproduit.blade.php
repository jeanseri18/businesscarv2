@extends('layouts.landing')

@section('title', 'Produit - ' . $offre->nom)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb -->
  

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Colonne gauche et centrale : Produit (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Image/PDF du produit -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    @if($offre->pdf_path || $offre->fichier)
                        <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center p-8">
                            <div class="text-center">
                                <i class="fas fa-file-pdf text-8xl text-red-600 mb-4"></i>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Documentation PDF</h4>
                                <p class="text-gray-600 mb-6">Consultez la documentation complète du produit</p>
                                <div class="flex justify-center gap-3">
                                    <a href="{{ asset('storage/' . ($offre->pdf_path ?? $offre->fichier)) }}" 
                                       target="_blank" 
                                       class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                        <i class="fas fa-eye mr-2"></i>Visualiser
                                    </a>
                                    <a href="{{ asset('storage/' . ($offre->pdf_path ?? $offre->fichier)) }}" 
                                       download 
                                       class="inline-flex items-center px-6 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition">
                                        <i class="fas fa-download mr-2"></i>Télécharger
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="aspect-video bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
                            <i class="fas fa-box-open text-8xl text-gray-300"></i>
                        </div>
                    @endif
                </div>

                <!-- Informations produit -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $offre->nom }}</h1>
                            <div class="flex items-center gap-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium accent-bg text-blue-900">
                                    <i class="fas fa-tag mr-1"></i>{{ ucfirst($offre->type) }}
                                </span>
                                <span class="text-gray-500">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ rand(50, 500) }} vues
                                </span>
                            </div>
                        </div>
                        <button class="p-2 rounded-full hover:bg-gray-100 transition">
                            <i class="far fa-heart text-xl text-gray-400 hover:text-yellow-500"></i>
                        </button>
                    </div>

                    <div class="border-t border-b py-4 my-4">
                        <div class="flex items-baseline gap-3">
                            <span class="text-4xl font-bold text-green-600">{{ number_format($offre->prix, 0, ',', ' ') }} FCFA</span>
                            <span class="text-sm text-gray-500">Prix unitaire</span>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $offre->detail ?? 'Découvrez ce produit exceptionnel proposé par notre partenaire de confiance. Qualité garantie et service professionnel.' }}
                        </p>
                    </div>

                    <!-- Caractéristiques -->
                    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <i class="fas fa-shield-alt text-2xl accent-color mb-2"></i>
                            <p class="text-xs text-gray-600">Qualité garantie</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <i class="fas fa-shipping-fast text-2xl accent-color mb-2"></i>
                            <p class="text-xs text-gray-600">Livraison rapide</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <i class="fas fa-headset text-2xl accent-color mb-2"></i>
                            <p class="text-xs text-gray-600">Support 24/7</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <i class="fas fa-undo text-2xl accent-color mb-2"></i>
                            <p class="text-xs text-gray-600">Retour facile</p>
                        </div>
                    </div>
                </div>

                <!-- Informations vendeur -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Vendu par</h3>
                    <div class="flex items-start gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-2xl font-bold">{{ substr($entreprise->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-900">{{ $entreprise->name }}</h4>
                            <div class="flex items-center gap-2 mt-1 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star-half-alt text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">(4.5/5 - {{ rand(20, 100) }} avis)</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-envelope w-5 text-gray-400"></i>
                                    <span>{{ $entreprise->email }}</span>
                                </div>
                                @if($entreprise->phone)
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-phone w-5 text-gray-400"></i>
                                    <span>{{ $entreprise->phone }}</span>
                                </div>
                                @endif
                                @if($entreprise->country)
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-map-marker-alt w-5 text-gray-400"></i>
                                    <span>{{ $entreprise->country }}</span>
                                </div>
                                @endif
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-calendar w-5 text-gray-400"></i>
                                    <span>Membre depuis {{ $entreprise->created_at ? $entreprise->created_at->format('Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne droite : Commande (1/3) -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Commander</h3>
                            <p class="text-sm text-gray-600">Remplissez le formulaire ci-dessous</p>
                        </div>
                        
                        <form action="{{ route('achat.store.public') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <input type="hidden" name="id_produit_service" value="{{ $offre->id }}">
                            <input type="hidden" name="code_commercial" value="{{ request('code_commercial') }}">
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Nom *</label>
                                    <input type="text" name="nom" required
                                           class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Prénom *</label>
                                    <input type="text" name="prenom" required
                                           class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Email *</label>
                                <input type="email" name="email" required
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">WhatsApp *</label>
                                <input type="text" name="whatsapp" required placeholder="+225XXXXXXXXX"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Type de client *</label>
                                <select name="type" required
                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Sélectionnez</option>
                                    <option value="particulier">Particulier</option>
                                    <option value="entreprise">Entreprise</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Quantité *</label>
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    <button type="button" onclick="decrementQty()" 
                                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition">
                                        <i class="fas fa-minus text-sm"></i>
                                    </button>
                                    <input type="number" name="quantite" id="quantite" required min="1" value="1"
                                           onchange="updateTotal()"
                                           class="w-full px-3 py-2 text-center text-sm border-0 focus:ring-0">
                                    <button type="button" onclick="incrementQty()"
                                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition">
                                        <i class="fas fa-plus text-sm"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="description" rows="2"
                                          class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                          placeholder="Besoins spécifiques..."></textarea>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Lieu de livraison</label>
                                <input type="text" name="lieu_livraison"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                       placeholder="Adresse">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Date souhaitée</label>
                                <input type="date" name="date_livraison"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Notes</label>
                                <textarea name="notes" rows="2"
                                          class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                          placeholder="Informations supplémentaires..."></textarea>
                            </div>
                            
                            <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-lg p-4 border border-yellow-200">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Total:</span>
                                    <span id="totalPrice" class="text-2xl font-bold accent-color">
                                        {{ number_format($offre->prix, 0, ',', ' ') }} FCFA
                                    </span>
                                </div>
                                <p class="text-xs text-gray-600">
                                    <span id="qtyDisplay">1</span> × {{ number_format($offre->prix, 0, ',', ' ') }} FCFA
                                </p>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full accent-bg text-blue-900 font-bold py-3.5 px-6 rounded-lg hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-200 shadow-lg hover:shadow-xl">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Commander maintenant
                            </button>

                            <div class="flex items-center justify-center gap-4 text-xs text-gray-500 pt-2">
                                <span><i class="fas fa-lock mr-1"></i>Paiement sécurisé</span>
                                <span><i class="fas fa-truck mr-1"></i>Livraison garantie</span>
                            </div>
                        </form>
                    </div>

                    <!-- Garanties -->
                    <div class="mt-4 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-lg p-4 border border-yellow-200">
                        <h4 class="font-semibold text-sm text-yellow-900 mb-3">Nos garanties</h4>
                        <ul class="space-y-2 text-xs text-yellow-800">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle accent-color mt-0.5"></i>
                                <span>Paiement 100% sécurisé</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle accent-color mt-0.5"></i>
                                <span>Garantie satisfait ou remboursé</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle accent-color mt-0.5"></i>
                                <span>Service client réactif</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const unitPrice = {{ $offre->prix }};
    
    function incrementQty() {
        const input = document.getElementById('quantite');
        input.value = parseInt(input.value) + 1;
        updateTotal();
    }
    
    function decrementQty() {
        const input = document.getElementById('quantite');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateTotal();
        }
    }
    
    function updateTotal() {
        const qty = parseInt(document.getElementById('quantite').value) || 1;
        const total = qty * unitPrice;
        document.getElementById('totalPrice').textContent = total.toLocaleString('fr-FR') + ' FCFA';
        document.getElementById('qtyDisplay').textContent = qty;
    }
</script>
@endsection