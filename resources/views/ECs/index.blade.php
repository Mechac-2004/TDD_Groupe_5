@extends('interface.interface')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Liste des Élément Constitutifs (ECs)</h1>
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($ECs->isEmpty())
        <p>Aucun enregistrement trouvé.</p>
    @else
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Code</th>
                    <th class="border border-gray-300 px-4 py-2">Nom</th>
                    <th class="border border-gray-300 px-4 py-2">Coefficient</th>
                    <th class="border border-gray-300 px-4 py-2">UE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ECs as $ec)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $ec->code }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $ec->nom }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $ec->coefficient }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $ec->uniteEnseignement->nom ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
