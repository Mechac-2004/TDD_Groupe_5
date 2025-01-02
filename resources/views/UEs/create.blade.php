@extends('interface.interface')

@section('title', 'Ajouter une UEs')

@section('content')
    <div class="container mx-auto py-15">
        <form action="{{ route('store') }}" method="POST" class="space-y-6 bg-white p-6 shadow-lg rounded-lg">
            @csrf
            
            <table class="min-w-full bg-gray-100 rounded-lg shadow-md">
                <thead class="bg-gray-300 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Code UE</th>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">ECTS</th>
                        <th class="px-4 py-2">Semestre</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="form-body">
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-2">
                            <input type="text" name="ues[0][code]" placeholder="Code UE" class="border border-gray-300 px-4 py-2 rounded-lg">
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" name="ues[0][nom]" placeholder="Nom" class="border border-gray-300 px-4 py-2 rounded-lg">
                        </td>
                        <td class="px-4 py-2">
                            <input type="number" name="ues[0][credits_ects]" placeholder="ECTS" class="border border-gray-300 px-4 py-2 rounded-lg">
                        </td>
                        <td class="px-4 py-2">
                            <select name="ues[0][semestre]" class="border border-gray-300 px-4 py-2 rounded-lg">
                                <option value="" selected disabled>Choisir...</option>
                                <option value="1">Semestre 1</option>
                                <option value="2">Semestre 2</option>
                            </select>
                        </td>
                        <td class="px-4 py-2">
                            <button type="button" class="text-red-500 remove-row">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Ajouter UE</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <script>
        document.getElementById('add-row').addEventListener('click', function() {
            const tbody = document.getElementById('form-body');
            const rowCount = tbody.children.length;

            const newRow ='
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="px-4 py-2">
                        <input type="text" name="ues[${rowCount}][code]" placeholder="Code UE" class="border border-gray-300 px-4 py-2 rounded-lg">
                    </td>
                    <td class="px-4 py-2">
                        <input type="text" name="ues[${rowCount}][nom]" placeholder="Nom" class="border border-gray-300 px-4 py-2 rounded-lg">
                    </td>
                    <td class="px-4 py-2">
                        <input type="number" name="ues[${rowCount}][credits_ects]" placeholder="ECTS" class="border border-gray-300 px-4 py-2 rounded-lg">
                    </td>
                    <td class="px-4 py-2">
                        <select name="ues[${rowCount}][semestre]" class="border border-gray-300 px-4 py-2 rounded-lg">
                            <option value="" selected disabled>Choisir...</option>
                            <option value="1">Semestre 1</option>
                            <option value="2">Semestre 2</option>
                        </select>
                    </td>
                    <td class="px-4 py-2">
                        <button type="button" class="text-red-500 remove-row">Supprimer</button>
                    </td>
                </tr>
            ';
            tbody.insertAdjacentHTML('beforeend', newRow);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
@endsection


