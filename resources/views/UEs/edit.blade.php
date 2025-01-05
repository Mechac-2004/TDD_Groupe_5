
@extends('interface.interface')

@section('title', 'Modification de l'Unité d'Enseignement')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Modifier l'Unité d'Enseignement</h1>

    <form action="{{ route('UEs.update', $UE->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="code" class="block font-medium">Code</label>
            <input type="text" id="code" name="code" value="{{ $UE->code }}" class="w-full border-gray-300 rounded p-2" required>
        </div>
        <div>
            <label for="nom" class="block font-medium">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ $UE->nom }}" class="w-full border-gray-300 rounded p-2" required>
        </div>
        <div>
            <label for="credits_ects" class="block font-medium">Crédits ECTS</label>
            <input type="number" id="credits_ects" name="credits_ects" value="{{ $UE->credits_ects }}" class="w-full border-gray-300 rounded p-2" required>
        </div>
        <div>
            <label for="semestre" class="block font-medium">Semestre</label>
            <select id="semestre" name="semestre" class="w-full border-gray-300 rounded p-2">
                @for ($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}" {{ $UE->semestre == $i ? 'selected' : '' }}>S{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Mettre à jour</button>
        </div>
    </form>
</div>

@endsection
