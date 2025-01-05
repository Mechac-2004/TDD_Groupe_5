
<!-- resources/views/ues/create.blade.php -->
@extends('interface.interface')

@section('content')
<div class="container mx-auto py-8">
<a href="{{ route('UEs.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Liste des UEs</a>
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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection
