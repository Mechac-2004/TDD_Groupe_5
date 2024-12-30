<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTION DES NOTES</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="https://www.hr-cafe.com/modules-hr-cafe/logiciel-rh-gestion-notes-frais/" class="text-2xl font-bold">
                Gestion de notes 
                </a>
                <ul class="flex space-x-4">
                    <li>
                        <a href="/" class="hover:text-gray-300">Accueil</a>
                    </li>
                    <li>
                        <a href="/about" class="hover:text-gray-300">infos</a>
                    </li>
                    <li>
                        <a href="/services" class="hover:text-gray-300">notes</a>
                    </li>
                    <li>
                        <a href="/contact" class="hover:text-gray-300">Resultat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container mx-auto mt-8">
        @yield('content')
    </main>
</body>
</html>
