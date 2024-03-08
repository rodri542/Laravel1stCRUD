<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Capturador temarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black">
    <div class="flex flex-col h-screen justify-between">
        <header>
            <div class="w-full h-50 bg-blue-300 text-white justify-center text-center">
                <a href="/pokecrud"><H1>BIENVENIDO A TU POKEDEX </H1></a>
            </div>
        </header>

        <main class="mb-auto bg-black ">
            @yield('contenido')
        </main>

        <footer>
            <div class="w-full bg-gray-300 -top-0">
                <p class="text-center">ITM CopyRight</p>
            </div>
        </footer>
    </div>
</body>
</html>
