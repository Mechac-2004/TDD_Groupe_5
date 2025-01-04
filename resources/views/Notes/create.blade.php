@extends('interface.interface')

@section('title', 'Enregistrer une nouvelle note')
@section('content')

    {{-- <a href="{{ route('Notes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Liste des notes</a> --}}

    <h1 class="text-2xl font-semibold mb-6">Ajouter une nouvelle note</h1>
    {{-- <form action="{{ route('Notes.store') }}" method="POST"> --}}
    <form action="" method="POST">
        @csrf
        <select name="ec_id">
            @foreach($ecs as $ec)
                <option value="{{ $ec->id }}">{{ $ec->code }} - {{ $ec->nom }}</option>
            @endforeach
        </select>
        <input type="number" name="note" min="0" max="20" step="0.25">
        <select name="session">
            <option value="normale">Session Normale</option>
            <option value="rattrapage">Rattrapage</option>
        </select>
        <button type="submit">Enregistrer</button>
    </form>
    

    <script>
        const oldValues = {
            niveau: @json(old('niveau')),
            etudiant_id: @json(old('etudiant_id')),
            ue_id: @json(old('ue_id')),
            ec_id: @json(old('ec_id'))
        };
    </script>
    @vite('resources/js/script.js')

@endsection