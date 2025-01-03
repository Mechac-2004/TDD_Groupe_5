@extends('interface.interface')

@section('title', 'Modifier une UE')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">Modifier une UE</h1>

        <form action="{{ route('UEs.update', $ues->id) }}" method="POST" class="space-y-6 bg-white p-6 shadow-lg rounded-lg">
            @csrf
            @method('PUT')

            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Code UE</label>
                <input type="text" name="code" id="code" value="{{ old('code', $ues->code) }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $ues->nom) }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="credits_ects" class="block text-sm font-medium text-gray-700">ECTS</label>
                <input type="number" name="credits_ects" id="credits_ects" value="{{ old('credits_ects', $ues->credits_ects) }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="semestre" class="block text-sm font-medium text-gray-700">Semestre</label>
                <select name="semestre" id="semestre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="1" {{ old('semestre', $ues->semestre) == 1 ? 'selected' : '' }}>Semestre 1</option>
                    <option value="2" {{ old('semestre', $ues->semestre) == 2 ? 'selected' : '' }}>Semestre 2</option>
                </select>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection
