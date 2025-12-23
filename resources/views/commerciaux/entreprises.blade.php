@extends('commerciaux.layouts.app')

@section('title', 'Entreprises Partenaires')
@section('page_title', 'Entreprises Partenaires')
@section('page_subtitle', 'Découvrez nos entreprises partenaires')

@section('content')
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('commercial.entreprises') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Nom de l'entreprise...">
                </div>
                <div class="min-w-[150px]">
                    <label for="pays" class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                    <select name="pays" id="pays" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les pays</option>
                        <option value="France" {{ request('pays') == 'France' ? 'selected' : '' }}>France</option>
                        <option value="Belgique" {{ request('pays') == 'Belgique' ? 'selected' : '' }}>Belgique</option>
                        <option value="Suisse" {{ request('pays') == 'Suisse' ? 'selected' : '' }}>Suisse</option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                    <a href="{{ route('commercial.entreprises') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        <i class="fas fa-times mr-2"></i>Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des entreprises -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-building mr-2 accent-color"></i>
                    Entreprises Partenaires
                </h3>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        Total: {{ $entreprises->total() }} entreprises
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($entreprises as $entreprise)
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ $entreprise->name }}
                                </h4>
                                <p class="text-sm text-gray-600 mb-3">{{ $entreprise->email }}</p>
                            </div>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Pays:</span>
                                <span class="font-medium">{{ $entreprise->country ?? 'Non spécifié' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Téléphone:</span>
                                <span class="font-medium">{{ $entreprise->phone ?? 'Non disponible' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Offres:</span>
                                <span class="font-bold text-blue-600">{{ $entreprise->offresEtServices->count() }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Inscription:</span>
                                <span class="font-medium">{{ $entreprise->created_at ? $entreprise->created_at->format('d/m/Y') : 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="flex space-x-2">
                            <a href="{{ route('commercial.entreprises.details', $entreprise) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i class="fas fa-eye mr-1"></i>
                                Détails
                            </a>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors" onclick="shareEntreprise('{{ $entreprise->name }}')">
                                <i class="fas fa-share mr-1"></i>
                                Partager
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <i class="fas fa-building text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500 text-lg">Aucune entreprise trouvée</p>
                            <p class="text-gray-400 text-sm mt-2">Aucune entreprise ne correspond à vos critères de recherche</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        @if($entreprises->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $entreprises->links() }}
            </div>
        @endif
    </div>

@endsection

@push('scripts')
<script>
function shareEntreprise(nom) {
    if (navigator.share) {
        navigator.share({
            title: 'Entreprise Partenaire - ' + nom,
            text: 'Découvrez cette entreprise partenaire sur notre plateforme.',
            url: window.location.href
        }).then(() => {
            console.log('Partage réussi');
        }).catch((error) => {
            console.log('Erreur de partage:', error);
        });
    } else {
        // Fallback pour les navigateurs qui ne supportent pas l'API Web Share
        alert('Partage disponible sur mobile ou navigateurs modernes');
    }
}
</script>
@endpush