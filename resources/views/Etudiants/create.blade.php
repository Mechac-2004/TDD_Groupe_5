
@extends('interface.interface')

@section('title', 'Ajouter Un Etudiant')

@section('content')

<form action="{{ route('Etudiants.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
{{-- <form action="" method="" class="space-y-6 bg-white p-6 rounded shadow"> --}}
    @csrf
    <h2 class="text-xl font-semibold">Étudiant</h2>
    <div>
        <label for="numero_etudiant" class="block font-medium">Numéro Étudiant</label>
        <input type="text" name="numero_etudiant" id="numero_etudiant" class="w-full border rounded px-4 py-2" required>
    </div>
    <div>
        <label for="nom" class="block font-medium">Nom</label>
        <input type="text" name="nom" id="nom" class="w-full border rounded px-4 py-2" required>
    </div>
    <div>
        <label for="prenom" class="block font-medium">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="w-full border rounded px-4 py-2" required>
    </div>
    <div>
        <label for="niveau" class="block font-medium">Niveau</label>
        <select name="niveau" id="niveau" class="w-full border rounded px-4 py-2">
            <option value="L1">L1</option>
            <option value="L2">L2</option>
            <option value="L3">L3</option>
        </select>
    </div>
    <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
        Enregistrer Étudiant
    </button>
</form>
@endsection