@extends('interface.interface')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Modifier un EC</h1>
    <form action="{{ route('ECs.update', $EC->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="code" class="block font-medium">Code</label>
            <input type="text" id="code" name="code" value="{{ $EC->code }}" class="w-full border-gray-300 rounded p-2" required>
        </div>
        <div>
            <label for="nom" class="block font-medium">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ $EC->nom }}" class="w-full border-gray-300 rounded p-2" required>
        </div>
        <div>
            <label for="coefficient" class="block font-medium">Coefficient</label>
            <input type="number" id="coefficient" name="coefficient" step="0.1" value="{{ $EC->coefficient }}" class="w-full border-gray-300 rounded p-2" required>
        </div>
        <div>
            <label for="ue_id" class="block font-medium">Unité d'Enseignement</label>
            <select id="ue_id" name="ue_id" class="w-full border-gray-300 rounded p-2">
                @foreach($UEs as $ue)
                    <option value="{{ $ue->id }}" @if($ue->id == $EC->ue_id) selected @endif>{{ $ue->nom }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
