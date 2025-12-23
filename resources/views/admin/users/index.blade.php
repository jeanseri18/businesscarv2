@extends('admin.layouts.app')

@section('title', 'Utilisateurs')
@section('page_title', 'Gestion des utilisateurs')
@section('page_subtitle', 'Liste de tous les utilisateurs de la plateforme')

@section('content')
    <div class="bg-white rounded-xl shadow-sm">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-users mr-2 accent-color"></i>
                        Liste des utilisateurs
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Total: {{ $users->total() }} utilisateurs</p>
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
                    <button class="accent-bg text-blue-900 px-4 py-2 rounded-lg font-medium hover:bg-yellow-400 transition-colors">
                        <i class="fas fa-plus mr-1"></i>
                        Ajouter
                    </button>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Utilisateur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rôle
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
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <i class="fas fa-phone mr-1 text-gray-400"></i>
                                    {{ $user->phone ?? 'Non renseigné' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-globe mr-1 text-gray-400"></i>
                                    {{ $user->country ?? 'Non renseigné' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($user->role === 'admin') bg-red-100 text-red-800
                                    @elseif($user->role === 'entreprise') bg-blue-100 text-blue-800
                                    @elseif($user->role === 'commercial') bg-purple-100 text-purple-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($user->role ?: 'utilisateur') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Vérifié
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Non vérifié
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.users.details', $user) }}" 
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
                                            onclick="return confirmDelete('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <i class="fas fa-users text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-500">Aucun utilisateur trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
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

    // Sort functionality
    function sortTable(column) {
        // Implementation for table sorting
        console.log('Sorting by column:', column);
    }
</script>
@endpush