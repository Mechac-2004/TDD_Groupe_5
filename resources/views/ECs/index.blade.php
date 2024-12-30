@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Liste des ECs</h1>
    <a href="{{ route('ECs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Ajouter un EC
    </a>
    <div class="mt-6">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="text-left py-2 px-4">Code EC</th>
                    <th class="text-left py-2 px-4">Nom</th>
                    <th class="text-left py-2 px-4">Coefficient</th>
                    <th class="text-left py-2 px-4">Unité d'Enseignement</th>
                    <th class="text-left py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ECs as $ec)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $ec->code }}</td>
                        <td class="py-2 px-4">{{ $ec->nom }}</td>
                        <td class="py-2 px-4">{{ $ec->coefficient }}</td>
                        <td class="py-2 px-4">{{ $ec->uniteEnseignement->nom }}</td>
                        <td class="py-2 px-4 flex space-x-2">
                            <a href="{{ route('ECs.edit', $ec->id) }}" class="text-blue-500 hover:underline">Modifier</a>
                            <form action="{{ route('ECs.destroy', $ec->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet EC ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
