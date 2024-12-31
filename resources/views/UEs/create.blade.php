<!-- resources/views/ues/create.blade.php -->
@extends('interface.interface')

@section('title', 'Ajouter une UEs' )

@section('content')

<form action="" method= "post">
    @csrf
        <div>
            <label class="block text-gray-700">Code UE</label>
            <input type="text" name="code" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>
        <div>
            <label class="block text-gray-700">Nom</label>
            <input type="text" name="nom" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>
        <div>
            <label class="block text-gray-700">ECTS</label>
            <input type="number" name="credits_ects" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>
        <div>
            <label class="block text-gray-700">Semestre</label>
            <input type="number" name="semestre" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Enregistrer
        </button>
</form>

@endsection