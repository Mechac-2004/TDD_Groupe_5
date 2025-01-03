<!-- resources/views/ues/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Liste des UEs</h1>
    <a href="{{ route('UEs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Ajouter une UE
    </a>
    <div class="mt-6">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="text-left py-2 px-4">Code UE</th>
                    <th class="text-left py-2 px-4">Nom</th>
                    <th class="text-left py-2 px-4">ECTS</th>
                    <th class="text-left py-2 px-4">Semestre</th>
                    <th class="text-left py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($UEs as $ue)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $ue->code }}</td>
                        <td class="py-2 px-4">{{ $ue->nom }}</td>
                        <td class="py-2 px-4">{{ $ue->credits_ects }}</td>
                        <td class="py-2 px-4">S{{ $ue->semestre }}</td>
                        <td class="py-2 px-4 flex space-x-2">
                            <a href="{{ route('UEs.edit', $ue->id) }}" class="text-blue-500 hover:underline">
                                Modifier
                            </a>
                            <form action="{{ route('UEs.destroy', $ue->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette UE ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
