@extends('interface.interface')

@section('title', 'Enregistrer une nouvelle note')

@section('content')

    <a href="{{ route('Notes') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Liste des notes</a>

    <h1 class="text-2xl font-semibold mb-6">Ajouter une nouvelle note</h1>

    <form action="{{ route('store_notes') }}" method="POST" class="max-w-xl mx-auto p-6 bg-white border border-gray-300 rounded shadow-sm">
        @csrf

        <div class="mb-4">
            <label for="niveau" class="block text-sm font-medium text-gray-700">Niveau</label>
            <select name="niveau" id="niveau" required class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="L1" @if(old('niveau') == 'L1') selected @endif>L1</option>
                <option value="L2" @if(old('niveau') == 'L2') selected @endif>L2</option>
                <option value="L3" @if(old('niveau') == 'L3') selected @endif>L3</option>
            </select>
            @error('niveau')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="etudiant_id" class="block text-sm font-medium text-gray-700">Étudiant</label>
            <select name="etudiant_id" id="etudiant_id" required class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner un étudiant</option>
                @if(old('etudiant_id'))
                    <option value="{{ old('etudiant_id') }}" selected>
                    </option>
                @endif
            </select>
            @error('etudiant_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ue_id" class="block text-sm font-medium text-gray-700">Unité d'Enseignement</label>
            <select name="ue_id" id="ue_id" required class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionnez une UE</option>
                @foreach($ues as $ue)
                    <option value="{{ $ue->id }}" @if(old('ue_id') == $ue->id) selected @endif>
                        {{ $ue->nom }}
                    </option>
                @endforeach
            </select>
            @error('ue_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ec_id" class="block text-sm font-medium text-gray-700">ECU</label>
            <select id="ec_id" name="ec_id" class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">Sélectionnez un EC</option>
                @if(old('ec_id'))
                    <option value="{{ old('ec_id') }}" selected>
                    </option>
                @endif
            </select>
            @error('ec_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
            <input type="number" name="note" id="note" value="{{ old('note') }}" required min="0" step="0.5" max="20" class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('note')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
            <select name="session" id="session" required class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="normale" @if(old('session') == 'normale') selected @endif>Normale</option>
                <option value="rattrapage" @if(old('session') == 'rattrapage') selected @endif>Rattrapage</option>
            </select>
            @error('session')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="date_evaluation" class="block text-sm font-medium text-gray-700">Date d'évaluation</label>
            <input type="date" name="date_evaluation" id="date_evaluation" value="{{ old('date_evaluation') }}" required class="mt-1 block w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('date_evaluation')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 mt-4 w-full">Enregistrer la note</button>
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