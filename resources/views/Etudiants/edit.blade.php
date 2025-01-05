@extends('interface.interface')

@section('title', 'Modifier un étudiant')

@section('content')

    <a href="{{ route('etudiants.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Liste des étudiants</a>

    <h1 class="text-2xl font-semibold mb-6">Modifier l'étudiant</h1>

    <form action="{{ route('etudiants.update', $etudiant) }}" method="POST" class="max-w-xl mx-auto p-6 bg-white border border-gray-300 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ $etudiant->nom }}" required class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('nom')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ $etudiant->prenom }}" required class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('prenom')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label for="niveau" class="block text-sm font-medium text-gray-700">Niveau</label>
            <select name="niveau" id="niveau" required class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="L1" @if($etudiant->niveau == 'L1') selected @endif>L1</option>
                <option value="L2" @if($etudiant->niveau == 'L2') selected @endif>L2</option>
                <option value="L3" @if($etudiant->niveau == 'L3') selected @endif>L3</option>
            </select>
            @error('niveau')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 mt-4 w-full">Mettre à jour</button>
    </form>
@endsection