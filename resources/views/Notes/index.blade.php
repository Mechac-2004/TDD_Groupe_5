@extends('interface.interface')

@section('title', 'Liste des notes')

@section('content')

    <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Enregistrer une nouvelle note</a>
    
    <h1 class="text-2xl font-semibold mb-6">Gestion des Notes</h1>

    <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="text-center">
                <th class="border border-gray-300 px-4 py-2">Matricule</th>
                <th class="border border-gray-300 px-4 py-2">Étudiant</th>
                <th class="border border-gray-300 px-4 py-2">Niveau</th>
                <th class="border border-gray-300 px-4 py-2">Unité d'Enseignement</th>
                <th class="border border-gray-300 px-4 py-2">Nom EC</th>
                <th class="border border-gray-300 px-4 py-2">Coeff EC</th>
                <th class="border border-gray-300 px-4 py-2">Note</th>
                <th class="border border-gray-300 px-4 py-2">Session</th>
                <th class="border border-gray-300 px-4 py-2">Date d'Évaluation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $note->etudiant_matricule }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $note->etudiant_nom }} {{ $note->etudiant_prenom }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $note->etudiant_niveau }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $note->ue_nom }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $note->ec_nom }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $note->ec_coeff }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $note->note }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $note->session }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $note->date_evaluation }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        const oldEcIds = @json(old('ec_id', []));
    </script>
    @vite('resources/js/script.js')
@endsection