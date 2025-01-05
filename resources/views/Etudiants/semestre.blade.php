@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-6">
            <span class="underline text-gray-500">Étudiant</span>: 
            {{ $etudiant->nom }} {{ $etudiant->prenom }}
        </h1>
    </div>

    @foreach ($resultatsParSemestre as $semestre => $resultats)
        <h2>Semestre {{ $semestre }}</h2>
        <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="text-center">
                    <th class="border border-gray-300 px-4 py-2">UE</th>
                    <th class="border border-gray-300 px-4 py-2">Moyenne</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultats['ues'] as $ue)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $ue['ue'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $ue['moyenne'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection