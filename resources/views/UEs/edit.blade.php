@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Modifier l'UE</h1>
    <form action="{{ route('UEs.update', ['UE' => $ue->id]) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="code" class="block text-sm font-medium text-gray-700">Code UE</label>
            <input type="text" name="code" id="code" value="{{ old('code', $ue->code) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $ue->nom) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="credits_ects" class="block text-sm font-medium text-gray-700">Crédits ECTS</label>
            <input type="number" name="credits_ects" id="credits_ects" value="{{ old('credits_ects', $ue->credits_ects) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="semestre" class="block text-sm font-medium text-gray-700">Semestre</label>
            <select name="semestre" id="semestre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @for ($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}" {{ $ue->semestre == $i ? 'selected' : '' }}>S{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
