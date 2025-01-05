@extends('interface.interface')

@section('title', 'Modification d'un élément Constitutif')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Modifier l'Élément Constitutif</h1>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ECs.update', $EC->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Champ Code -->
        <div>
            <label for="code" class="block font-semibold">Code</label>
            <input type="text" id="code" name="code" value="{{ old('code', $EC->code) }}"
                class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required>
        </div>

        <!-- Champ Nom -->
        <div>
            <label for="nom" class="block font-semibold">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $EC->nom) }}"
                class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required>
        </div>

        <!-- Champ Coefficient -->
        <div>
            <label for="coefficient" class="block font-semibold">Coefficient</label>
            <input type="number" step="0.1" id="coefficient" name="coefficient" value="{{ old('coefficient', $EC->coefficient) }}"
                class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required>
        </div>

        <!-- Dropdown UE -->
        <div>
            <label for="ue_id" class="block font-semibold">Unité d'Enseignement</label>
            <select id="ue_id" name="ue_id"
                class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                <option value="" disabled>Choisissez une UE</option>
                @foreach ($UEs as $ue)
                    <option value="{{ $ue->id }}" {{ $EC->ue_id == $ue->id ? 'selected' : '' }}>
                        {{ $ue->nom }} ({{ $ue->code }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Boutons -->
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Enregistrer
            </button>
            <a href="{{ route('ECs.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
