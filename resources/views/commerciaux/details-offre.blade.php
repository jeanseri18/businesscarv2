@extends('commerciaux.layouts.app')

@section('title', 'Détails de l\'offre')
@section('page_title', 'Détails de l\'offre')
@section('page_subtitle', $offre->nom)

@section('content')
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-file-alt mr-2 accent-color"></i>
                    Détails de l\'offre
                </h3>
                <a href="{{ route('commercial.offres') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-left mr-2"></i>Retour aux offres
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Colonne gauche : PDF -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-file-pdf mr-2 text-red-600"></i>
                        Documentation
                    </h4>
                    
                    @if($offre->pdf_path || $offre->fichier)
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <i class="fas fa-file-pdf text-6xl text-red-600 mb-4"></i>
                            <h5 class="text-lg font-medium text-gray-900 mb-2">Documentation PDF</h5>
                            <p class="text-gray-600 mb-4">Cliquez pour visualiser ou télécharger le document</p>
                            <div class="space-y-2">
                                <a href="{{ asset('storage/' . ($offre->pdf_path ?? $offre->fichier)) }}" 
                                   target="_blank" 
                                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    <i class="fas fa-eye mr-2"></i>Voir le PDF
                                </a>
                                <a href="{{ asset('storage/' . ($offre->pdf_path ?? $offre->fichier)) }}" 
                                   download 
                                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 ml-2">
                                    <i class="fas fa-download mr-2"></i>Télécharger
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <i class="fas fa-file-excel text-6xl text-gray-400 mb-4"></i>
                            <h5 class="text-lg font-medium text-gray-900 mb-2">Aucun document</h5>
                            <p class="text-gray-600">Aucune documentation PDF n\'est disponible pour cette offre.</p>
                        </div>
                    @endif
                </div>

                <!-- Colonne droite : Détails -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $offre->nom }}</h1>
                        <p class="text-gray-600">{{ $offre->description }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-gray-600 mb-1">Catégorie</h5>
                            <p class="text-lg font-semibold text-gray-900">{{ $offre->categorie ?? 'Non définie' }}</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-gray-600 mb-1">Type</h5>
                            <p class="text-lg font-semibold text-gray-900">{{ ucfirst($offre->type) }}</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-gray-600 mb-1">Prix</h5>
                            <p class="text-lg font-bold text-green-600">{{ number_format($offre->prix, 0, ',', ' ') }} FCFA</p>
                        </div>
                        
                        @if($offre->commission_rate)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h5 class="text-sm font-medium text-gray-600 mb-1">Commission</h5>
                                <p class="text-lg font-semibold text-purple-600">{{ $offre->commission_rate }}%</p>
                            </div>
                        @endif
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-gray-600 mb-1">Statut</h5>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ ucfirst($offre->statut) }}
                            </span>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-gray-600 mb-1">Date de création</h5>
                            <p class="text-lg font-semibold text-gray-900">{{ $offre->created_at ? $offre->created_at->format('d/m/Y') : 'Non disponible' }}</p>
                        </div>
                    </div>

                    <!-- Bouton Partager -->
                    <div class="pt-4 border-t border-gray-200">
                        <button onclick="partagerOffre()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-share mr-2"></i>Partager cette offre
                        </button>
                        <div class="mt-2 text-sm text-gray-600 text-center">
                            <p>Lien de partage :</p>
                            <input type="text" id="share-link" class="w-full px-2 py-1 text-xs border rounded mt-1" readonly>
                            <button onclick="copierLien()" class="mt-2 px-3 py-1 bg-gray-200 text-gray-700 rounded text-xs hover:bg-gray-300">
                                <i class="fas fa-copy mr-1"></i>Copier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Générer le lien de partage avec le code commercial
        function genererLienPartage() {
            const codeCommercial = '{{ auth()->user()->code_commercial ?? "" }}';
            const produitId = '{{ $offre->id }}';
            const baseUrl = window.location.origin;
            const shareUrl = `${baseUrl}/produit/${produitId}?code_commercial=${codeCommercial}`;
            document.getElementById('share-link').value = shareUrl;
            return shareUrl;
        }

        function partagerOffre() {
            const shareUrl = genererLienPartage();
            
            if (navigator.share) {
                navigator.share({
                    title: '{{ $offre->nom }}',
                    text: '{{ $offre->description }}',
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
@endsection