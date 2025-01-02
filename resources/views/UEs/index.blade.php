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
                </tr>
            </thead>
            <tbody>
                @forelse($ues as $ue)
                    <tr class="border-t border-gray-300 hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $ue->code }}</td>
                        <td class="px-4 py-2">{{ $ue->nom }}</td>
                        <td class="px-4 py-2">{{ $ue->credits_ects }}</td>
                        <td class="px-4 py-2">S{{ $ue->semestre }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">Aucun enregistrement trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
