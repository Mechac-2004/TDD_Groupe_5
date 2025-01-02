<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des UEs et ECs')</title>
    @vite('resources/css/app.css') <!-- Charger les styles Tailwind -->
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navigation -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="" class="text-xl font-bold">Système de Gestion des Notes UniversitaireS - LMD</a>
            <div>         
                 <a href="{{route('UEs')}}" class="px-4 py-2 hover:bg-gray-700 rounded">Unités d'Enseignement</a>
                <a href="{{route('ECs')}}" class="px-4 py-2 hover:bg-gray-700 rounded">Éléments Constitutifs</a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mx-auto mt-8 px-4">
        @yield('content')
    </div>

    <!-- Pied de page -->
    <footer class="bg-blue-600 text-white shadow-lg">
        &copy; {{ date('Y') }} Système de Gestion des Notes UniversitaireS - LMD. Tous droits réservés.
    </footer>
</body>
</html>


