<!-- resources/views/ues/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Ajouter une UE</h1>
    <form action="{{ route('UEs.store') }}" method="POST" class="space-y-4">
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
</div>
@endsection
