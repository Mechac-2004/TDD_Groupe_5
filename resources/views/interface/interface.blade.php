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
                 <a href="{{route('UEs.create')}}" class="px-4 py-2 hover:bg-gray-700 rounded">Unités d'Enseignement</a>
                <a href="{{route('ECs.create')}}" class="px-4 py-2 hover:bg-gray-700 rounded">Éléments Constitutifs</a>
                <a href="{{route('Etudiants.create')}}" class="px-4 py-2 hover:bg-gray-700 rounded">Etudiants</a>
                <a href="{{route('Notes.create')}}" class="px-4 py-2 hover:bg-gray-700 rounded">Notes</a>
                <a href="{{route('Resultats.create')}}" class="px-4 py-2 hover:bg-gray-700 rounded">Resultats</a>
            </div>
        </div>
    </nav>
<P>
    
    <section id="features" class="py-5">
        <div class="container">
          <h3 class="text-3xl font-bold text-center mb-8">Fonctionnalités Clés</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
           
              <div class="bg-yellow shadow-lg rounded-lg p-6 text-center">
                <h5  class="text-xl font-semibold mb-2">GESTION DES UNITES D'ENSEIGNEMENT</h5>
                <p class="text-gray-600">BIEN GERER LES ELEMENTS CONSTITUTIFS.</p>
              </div>
            


              <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h5 class="text-xl font-semibold mb-2">GESTION DES ELEMENTS CONSTITUTIFS</h5>
                <p class="text-gray-600">Gérez les elements constitutif  en toute simplicité.</p>
              </div>


            
              <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h5 class="text-xl font-semibold mb-2">GESTION DES Etudiants</h5>
                <p class="text-gray-600">Gérez leS etudiants.</p>
              </div>
          

            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
              <div class="card p-3">
                <h5 class="text-xl font-semibold mb-2">GESTION DES NOTES <i class="fas fa-notes-medical    "></i></h5>
                <p class="text-gray-600">Facilite la gestion des Notes</p>
              </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
              <div class="card p-3">
                <h5 class="text-xl font-semibold mb-2">GESTION DES RESULTATS <i class="fas fa-notes-medical    "></i></h5>
                <p class="text-gray-600">Facilite la gestion des Resultats</p>
              </div>
            </div>

          </div>
        </div>
      </section>

</P>
    
    <div class="container mx-auto mt-8 px-4">
        @yield('content')
    </div>

    <footer class="bg-blue-600 text-white shadow-lg">
        &copy; {{ date('Y') }} Système de Gestion des Notes UniversitaireS - LMD. Tous droits réservés.
    </footer>
</body>
</html>


