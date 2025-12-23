@extends('commerciaux.layouts.app')

@section('title', $entreprise->name)
@section('page_title', $entreprise->name)
@section('page_subtitle', 'Détails de l\'entreprise')

@section('content')
<div class="flex-grow">
    <!-- Navigation -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('commercial.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                            <i class="fas fa-home mr-2"></i>Tableau de bord
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('commercial.entreprises') }}" class="text-gray-700 hover:text-blue-600 ml-1">Entreprises</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-gray-500 ml-1">{{ $entreprise->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- En-tête de l'entreprise -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center mb-4 lg:mb-0">
                    <div class="bg-gray-100 rounded-full flex items-center justify-center mr-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-building text-2xl accent-color"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $entreprise->name }}</h2>
                        <p class="text-gray-600 mb-3">{{ $entreprise->email }}</p>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <span class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>{{ $entreprise->country ?? 'Pays non spécifié' }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-phone mr-2"></i>{{ $entreprise->phone ?? 'Téléphone non disponible' }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-2"></i>Membre depuis {{ $entreprise->created_at ? $entreprise->created_at->format('d/m/Y') : 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-6 text-center">
                    <div>
                        <h4 class="text-2xl font-bold text-blue-600 mb-1">{{ $entreprise->offresEtServices->count() }}</h4>
                        <p class="text-sm text-gray-600">Offres</p>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-green-600 mb-1">{{ $entreprise->commissions->count() }}</h4>
                        <p class="text-sm text-gray-600">Commissions</p>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-purple-600 mb-1">{{ $entreprise->subscriptions->count() }}</h4>
                        <p class="text-sm text-gray-600">Abonnements</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6">
            <div class="flex flex-wrap gap-3">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" onclick="shareEntreprise('{{ $entreprise->name }}')">
                    <i class="fas fa-share-alt mr-2"></i>Partager l'entreprise
                </button>
                <div class="mt-2 text-sm text-gray-600">
                    <p>Lien de partage :</p>
                    <input type="text" id="share-link" class="w-full px-2 py-1 text-xs border rounded mt-1" readonly>
                    <button onclick="copierLien()" class="mt-2 px-3 py-1 bg-gray-200 text-gray-700 rounded text-xs hover:bg-gray-300">
                        <i class="fas fa-copy mr-1"></i>Copier
                    </button>
                </div>
                <a href="mailto:{{ $entreprise->email }}" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-envelope mr-2"></i>Contacter
                </a>
                <a href="{{ route('commercial.offres') }}?entreprise={{ $entreprise->id }}" class="px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                    <i class="fas fa-shopping-cart mr-2"></i>Voir les offres
                </a>
            </div>
        </div>
    </div>

    <!-- Offres de l'entreprise -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h5 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-briefcase mr-2 accent-color"></i>
                Offres et Services de {{ $entreprise->name }}
            </h5>
        </div>
        <div class="p-6">
            @if($entreprise->offresEtServices->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($entreprise->offresEtServices as $offre)
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h6 class="text-lg font-semibold text-gray-900 mb-2">{{ $offre->nom }}</h6>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $offre->type }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="text-sm text-gray-600 mb-3">
                                {{ Str::limit($offre->description, 100) }}
                            </p>

                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Catégorie:</span>
                                    <span class="font-medium">{{ $offre->categorie }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Créé le:</span>
                                    <span class="font-medium">{{ $offre->created_at ? $offre->created_at->format('d/m/Y') : 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-green-600 font-bold">{{ number_format($offre->prix, 2, ',', ' ') }} €</span>
                                    @if($offre->commission_rate)
                                        <div class="text-sm text-purple-600">
                                            <i class="fas fa-percentage mr-1"></i>{{ $offre->commission_rate }}% commission
                                        </div>
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('commercial.offres.details', $offre) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors" onclick="shareOffre('{{ $offre->nom }}')">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-briefcase text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-lg">Aucune offre disponible</p>
                    <p class="text-gray-400 text-sm mt-2">Cette entreprise n'a pas encore publié d'offres.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
// Générer le lien de partage avec le code commercial
function genererLienPartage() {
    const codeCommercial = '{{ auth()->user()->code_commercial ?? "" }}';
    const baseUrl = window.location.origin;
    const shareUrl = `${baseUrl}/commercial/entreprises/{{ $entreprise->id }}?code_commercial=${codeCommercial}`;
    document.getElementById('share-link').value = shareUrl;
    return shareUrl;
}

function shareEntreprise(nom) {
    const shareUrl = genererLienPartage();
    
    if (navigator.share) {
        navigator.share({
            title: 'Entreprise Partenaire - ' + nom,
            text: 'Découvrez cette entreprise partenaire sur notre plateforme.',
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

function shareOffre(nom) {
    const shareUrl = genererLienPartage();
    
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
        alert('Partage disponible sur mobile ou navigateurs modernes');
    }
}

function copierLien() {
    const shareUrl = genererLienPartage();
    navigator.clipboard.writeText(shareUrl).then(() => {
        alert('Lien copié dans le presse-papiers !');
    }).catch(() => {
        alert('Impossible de copier le lien');
    });
}

// Générer le lien au chargement de la page
document.addEventListener('DOMContentLoaded', genererLienPartage);
</script>
@endpush
</div>
@endsection