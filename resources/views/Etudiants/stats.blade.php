@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-6">
            <span class="underline text-gray-500">Étudiant</span>: 
            {{ $etudiant->nom }} {{ $etudiant->prenom }}
        </h1>

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nom UE</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Crédit ECTS</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nom EC</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Coefficient EC</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Note EC</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Moyenne UE</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Statut UE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stats as $stat)
                    <!-- Ligne de l'UE -->
                    <tr class="bg-gray-100">
                        <td rowspan="{{ count($stat['elementsConstitutifs']) + 1 }}" class="border border-gray-300 px-4 py-2 align-middle text-center font-bold">
                            {{ $stat['ue']->nom }}
                        </td>
                        <td rowspan="{{ count($stat['elementsConstitutifs']) + 1 }}" class="border border-gray-300 px-4 py-2 align-middle text-center">
                            {{ $stat['ue']->credits_ects }}
                        </td>
                        <td colspan="3" class="border border-gray-300 px-4 py-2 text-center italic font-semibold">
                            Éléments Constitutifs (EC)
                        </td>
                        <td rowspan="{{ count($stat['elementsConstitutifs']) + 1 }}" class="border border-gray-300 px-4 py-2 align-middle text-center">
                            {{ $stat['moyenne'] !== null ? number_format($stat['moyenne'], 2) : 'Non calculée' }}
                        </td>
                        <td rowspan="{{ count($stat['elementsConstitutifs']) + 1 }}" class="border border-gray-300 px-4 py-2 align-middle text-center">
                            @if ($stat['moyenne'] >= 10)
                                <span class="bg-green-500 text-white px-2 py-1 rounded">Validée</span>
                            @elseif ($stat['moyenne'] !== null)
                                <span class="bg-red-500 text-white px-2 py-1 rounded">Non validée</span>
                            @else
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded">Non calculée</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Lignes des EC -->
                    @foreach ($stat['elementsConstitutifs'] as $ec)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $ec->nom }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $ec->coefficient }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @php
                                    $note = $stat['notes']->firstWhere('ec_id', $ec->id);
                                @endphp
                                {{ $note ? number_format($note->note, 2) : 'Non évalué' }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex items-center justify-between">
            <h3 class="text-xl font-semibold">
                <span class="underline text-gray-500">Moyenne générale</span> : 
                <span class="">{{ $moyenneGenerale !== null ? number_format($moyenneGenerale, 2) : 'Non calculée' }}</span>
            </h3>
            @if ($moyenneGenerale !== null)
                <div class="text-lg font-semibold">
                    @if ($moyenneGenerale >= 10)
                        <span class="bg-green-500 text-white px-4 py-2 rounded">Passe en classe supérieure</span>
                    @else
                        <span class="bg-red-500 text-white px-4 py-2 rounded">Ne passe pas en classe supérieure</span>
                    @endif
                </div>
            @else
                <div class="text-lg font-semibold text-yellow-500">
                    Moyenne non calculée
                </div>
            @endif
        </div>
    </div>
@endsection