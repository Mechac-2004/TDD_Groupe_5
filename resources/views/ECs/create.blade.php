@extends('interface.interface')
@section('title', 'Ajouter un EC')
@section('content')

<div class="container mx-auto py-15">
    <h1 class="text-2xl font-bold mb-6">Ajouter un EC</h1>
    <form action="{{ route('store') }}" method="POST" class="space-y-2 bg-white p-2 shadow-lg rounded-lg  flex justify-between items-center bg-gray-100 p-4">
        @csrf
        <div>
            <label for="code" class="block font-normal text-sm">Code</label>
            <input type="text" id="code" name="code" class="space-y-2 bg-white p-6 shadow-lg rounded-lg" required>
        </div>
        <div>
            <label for="nom" class="block font-normal text-sm">Nom</label>
            <input type="text" id="nom" name="nom" class="space-y-2 bg-white p-6 shadow-lg rounded-lg" required>
        </div>
        <div>
            <label for="coefficient" class="block font-normal text-sm">Coefficient</label>
            <input type="number" id="coefficient" name="coefficient" step="0.1" class="space-y-2 bg-white p-6 shadow-lg rounded-lg" required>
        </div>
        <div>
            <label for="ue_id" class="block font-normal text-sm">Unité d'Enseignement</label>
            <label for="nom" class="block font-normal text-sm"></label>
            <input type="text" id="ue_id" name="ue_i" class="space-y-2 bg-white p-6 shadow-lg rounded-lg" required>
            {{-- <select id="ue_id" name="ue_id" class="w-full border-gray-300 rounded p-2"> --}}
                
                @foreach($ecs as $ec)
                    <option value="{{ $ec->id }}">{{ $ec->nom }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter</button>
        </div>
    </form>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
        @endif
</div>

@endsection