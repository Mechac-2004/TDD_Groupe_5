@extends('interface.interface')

@section('title', 'Liste des UEs')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Liste des UEs</h1>
    <table class="min-w-full bg-white border rounded-lg shadow-lg">
        <thead class="bg-gray-200 text-sm font-semibold text-gray-700">
            <tr>
                <th class="px-4 py-2">Code UE</th>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">ECTS</th>
                <th class="px-4 py-2">Semestre</th>
                <th class="px-4 py-2">Actions</th> <!-- Nouvelle colonne pour les actions -->
            </tr>
        </thead>
        <tbody>
            @forelse($ues as $ue)
                <tr class="border-t border-gray-300 hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $ue->code }}</td>
                    <td class="px-4 py-2">{{ $ue->nom }}</td>
                    <td class="px-4 py-2">{{ $ue->credits_ects }}</td>
                    <td class="px-4 py-2">S{{ $ue->semestre }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <!-- Bouton Modifier -->
                        <a href="{{ route('UEs.edit', $ue->id) }}" class="text-blue-600 hover:underline">
                            Modifier
                        </a>

                        <!-- Formulaire de suppression -->
                        <form action="{{ route('UEs.destroy', $ue->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette UE ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">Aucun enregistrement trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
