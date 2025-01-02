
@extends('interface.interface')

@section('title', 'Ajouter une UEs' )

@section('content')

    <form action="{{ route('store') }}" method= "post" class="space-y-4>
        @csrf

        <table>
            <thead>
                <tr>
                    <th>Code UE</th>
                    <th>Nom</th>
                    <th>ECTS</th>
                    <th>Semestre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @if(isset($ues) && $ues->isNotEmpty())
            <tbody>
                @foreach($ues as $ue)
                    <tr>
                        <td>{{ $ue->code }}</td>
                        <td>{{ $ue->nom }}</td>
                        <td>{{ $ue->credits_ects }}</td>
                        <td>S{{ $ue->semestre }}</td>
                        <td>
                            <!-- Actions -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </form>
    <div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success')}}
    </div>
    @endif

@endsection 




