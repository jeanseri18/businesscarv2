@extends('commerciaux.layouts.app')

@section('title', 'Offres Disponibles')
@section('page_title', 'Offres Disponibles')
@section('page_subtitle', 'Produits et services disponibles pour la vente')

@section('content')
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('commercial.offres') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Nom ou description...">
                </div>
                <div class="min-w-[150px]">
                    <label for="categorie" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <select name="categorie" id="categorie" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Toutes les catégories</option>
                        <option value="digital" {{ request('categorie') == 'digital' ? 'selected' : '' }}>Digital</option>
                        <option value="physique" {{ request('categorie') == 'physique' ? 'selected' : '' }}>Physique</option>
                        <option value="service" {{ request('categorie') == 'service' ? 'selected' : '' }}>Service</option>
                        <option value="formation" {{ request('categorie') == 'formation' ? 'selected' : '' }}>Formation</option>
                    </select>
                </div>
                <div class="min-w-[150px]">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les types</option>
                        <option value="produit" {{ request('type') == 'produit' ? 'selected' : '' }}>Produit</option>
                        <option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Service</option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                    <a href="{{ route('commercial.offres') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        <i class="fas fa-times mr-2"></i>Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-store mr-2 accent-color"></i>
                    Offres Disponibles
                </h3>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        Total: {{ $offres->total() }} offres
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($offres as $offre)
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ $offre->nom }}
                                </h4>
                                <p class="text-sm text-gray-600 mb-3">
                                    {{ Str::limit($offre->description, 100) }}
                                </p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ ucfirst($offre->statut) }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Catégorie:</span>
                                <span class="font-medium">{{ $offre->categorie ?? 'Non définie' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Type:</span>
                                <span class="font-medium">{{ ucfirst($offre->type) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Prix:</span>
                                <span class="font-bold text-green-600">{{ number_format($offre->prix, 0, ',', ' ') }} FCFA</span>
                            </div>
                            @if($offre->commission_rate)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Commission:</span>
                                    <span class="font-medium text-purple-600">{{ $offre->commission_rate }}%</span>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-xs text-gray-500">
                                Créé le {{ $offre->created_at ? $offre->created_at->format('d/m/Y') : 'Date non disponible' }}
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('commercial.offres.details', $offre->id) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fas fa-eye mr-1"></i>
                                    Détails
                                </a>
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors" onclick="partagerOffre({{ $offre->id }}, '{{ $offre->nom }}')">
                                    <i class="fas fa-share mr-1"></i>
                                    Partager
                                </button>
                                <div class="mt-2 text-xs text-gray-600">
                                    <input type="text" id="share-link-{{ $offre->id }}" class="w-full px-2 py-1 text-xs border rounded" readonly style="display:none;">
                                    <button onclick="copierLien({{ $offre->id }})" class="mt-1 px-2 py-1 bg-gray-200 text-gray-700 rounded text-xs hover:bg-gray-300" style="display:none;">
                                        <i class="fas fa-copy mr-1"></i>Copier
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <i class="fas fa-store text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500 text-lg">Aucune offre disponible</p>
                            <p class="text-gray-400 text-sm mt-2">Revenez plus tard pour découvrir de nouvelles offres</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        @if($offres->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $offres->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
// Générer le lien de partage avec le code commercial pour chaque offre
function genererLienPartage(offreId) {
    const codeCommercial = '{{ auth()->user()->code_commercial ?? "" }}';
    const baseUrl = window.location.origin;
    const shareUrl = `${baseUrl}/produit/${offreId}?code_commercial=${codeCommercial}`;
    document.getElementById(`share-link-${offreId}`).value = shareUrl;
    document.getElementById(`share-link-${offreId}`).style.display = 'block';
    document.querySelector(`#share-link-${offreId} + button`).style.display = 'block';
    return shareUrl;
}

function partagerOffre(offreId, nom) {
    const shareUrl = genererLienPartage(offreId);
    
    if (navigator.share) {
        navigator.share({
            title: 'Offre Spéciale - ' + nom,
            text: 'Découvrez cette offre spéciale sur notre plateforme.',
            url: shareUrl
        }).then(() => {
            console.log('Partage réussi');
        }).catch((error) => {
            console.log('Erreur de partage:', error);
        });
    } else {
        // Fallback pour les navigateurs qui ne supportent pas l'API Web Share
        navigator.clipboard.writeText(shareUrl).then(() => {
            alert('Lien copié dans le presse-papiers !');
        }).catch(() => {
            alert('Impossible de copier le lien');
        });
    }
}

function copierLien(offreId) {
    const shareUrl = document.getElementById(`share-link-${offreId}`).value;
    navigator.clipboard.writeText(shareUrl).then(() => {
        alert('Lien copié dans le presse-papiers !');
    }).catch(() => {
        alert('Impossible de copier le lien');
    });
}
</script>
@endpush