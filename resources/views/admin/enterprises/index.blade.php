@extends('admin.layouts.app')

@section('title', 'Entreprises')
@section('page_title', 'Gestion des entreprises')
@section('page_subtitle', 'Liste de toutes les entreprises inscrites')

@section('content')
    <div class="bg-white rounded-xl shadow-sm">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-building mr-2 accent-color"></i>
                        Liste des entreprises
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Total: {{ $enterprises->total() }} entreprises</p>
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
                        <option value="">Tous les secteurs</option>
                        <option value="primary">Primaire</option>
                        <option value="secondary">Secondaire</option>
                        <option value="tertiary">Tertiaire</option>
                        <option value="premium">Premium</option>
                    </select>
                    <button class="accent-bg text-blue-900 px-4 py-2 rounded-lg font-medium hover:bg-yellow-400 transition-colors">
                        <i class="fas fa-plus mr-1"></i>
                        Ajouter
                    </button>
                </div>
            </div>
        </div>

        <!-- Enterprises Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Entreprise
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Secteur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Responsable
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date d'inscription
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($enterprises as $enterprise)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-building text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $enterprise->company_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $enterprise->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($enterprise->sector === 'premium') bg-purple-100 text-purple-800
                                    @elseif($enterprise->sector === 'tertiary') bg-blue-100 text-blue-800
                                    @elseif($enterprise->sector === 'secondary') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($enterprise->sector ?: 'Non défini') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <i class="fas fa-phone mr-1 text-gray-400"></i>
                                    {{ $enterprise->phone ?? 'Non renseigné' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-1 text-gray-400"></i>
                                    {{ $enterprise->address ?? 'Non renseigné' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $enterprise->legal_representative }}</div>
                                <div class="text-sm text-gray-500">{{ $enterprise->subscriber_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($enterprise->status === 'active') bg-green-100 text-green-800
                                    @elseif($enterprise->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($enterprise->status === 'suspended') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($enterprise->status ?: 'en attente') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $enterprise->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.enterprises.details', $enterprise) }}" 
                                       class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                       title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="text-gray-600 hover:text-gray-900 p-2 rounded-lg hover:bg-gray-50 transition-colors"
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                            title="Supprimer"
                                            onclick="return confirmDelete('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <i class="fas fa-building text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500">Aucune entreprise trouvée</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($enterprises->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $enterprises->links() }}
            </div>
        @endif
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

    // Sector filter
    document.querySelector('select').addEventListener('change', function() {
        const sector = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (sector === '' || text.includes(sector)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function confirmDelete(message) {
        return confirm(message);
    }
</script>
@endpush