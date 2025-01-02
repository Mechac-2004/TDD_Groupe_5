@extends('layouts.app')

@section('title', 'Liste des étudiants')

@section('content')

    <a href="{{ route('etudiants.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Ajouter un étudiant</a>

    @if (session('success'))
    <div class="">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-2xl font-semibold mb-6">Liste des étudiants</h1>

    @if ($etudiants->isEmpty())
        <p>Aucun étudiant enregistré.</p>
    @else
        <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="text-center">
                    <th class="border border-gray-300 px-4 py-2">Numéro étudiant</th>
                    <th class="border border-gray-300 px-4 py-2">Nom</th>
                    <th class="border border-gray-300 px-4 py-2">Prénom</th>
                    <th class="border border-gray-300 px-4 py-2">Niveau</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etudiants as $etudiant)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $etudiant->numero_etudiant }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $etudiant->nom }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $etudiant->prenom }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $etudiant->niveau }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('etudiants.edit', $etudiant) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Modifier</a>
                            <a href="{{ route('etudiants.stats', $etudiant) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Voir les stats</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection