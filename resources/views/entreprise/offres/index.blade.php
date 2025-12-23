@extends('entreprise.layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-tags mr-2 accent-color"></i>
                        Mes Offres
                    </h3>
                    <a href="{{ route('entreprise.offres.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i> Créer une offre
                    </a>
                </div>
                
                @if(isset($offres) && $offres->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($offres as $offre)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $offre->nom }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $offre->detail }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($offre->prix, 2) }} F CFA</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($offre->type) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Actif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('entreprise.offres.edit', $offre) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('entreprise.offres.destroy', $offre) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(isset($offres) && method_exists($offres, 'links'))
                        <div class="mt-4">
                            {{ $offres->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-tags text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Aucune offre créée pour le moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection