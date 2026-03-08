<!DOCTYPE html>
<html>
<head>
    <title>Mi tienda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800">

<div class="w-[900px] p-8 bg-slate-800 rounded-xl shadow-xl text-white">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="/logo.png" class="w-24">
    </div>

    <h1 class="text-2xl font-bold text-center mb-8">
        Bienvenido a la tienda
    </h1>

    <!-- Productos -->
    <div class="grid grid-cols-3 gap-6">

        <div class="bg-slate-700 p-4 rounded-lg text-center">
            <img src="https://via.placeholder.com/150" class="mx-auto mb-3 rounded">
            <h2 class="font-bold">Producto 1</h2>
            <p class="text-cyan-400 mb-3">$10</p>

            <x-mary-button class="bg-cyan-600 hover:bg-cyan-500 text-white w-full">
                Comprar
            </x-mary-button>
        </div>

        <div class="bg-slate-700 p-4 rounded-lg text-center">
            <img src="https://via.placeholder.com/150" class="mx-auto mb-3 rounded">
            <h2 class="font-bold">Producto 2</h2>
            <p class="text-cyan-400 mb-3">$20</p>

            <x-mary-button class="bg-cyan-600 hover:bg-cyan-500 text-white w-full">
                Comprar
            </x-mary-button>
        </div>

        <div class="bg-slate-700 p-4 rounded-lg text-center">
            <img src="https://via.placeholder.com/150" class="mx-auto mb-3 rounded">
            <h2 class="font-bold">Producto 3</h2>
            <p class="text-cyan-400 mb-3">$30</p>

            <x-mary-button class="bg-cyan-600 hover:bg-cyan-500 text-white w-full">
                Comprar
            </x-mary-button>
        </div>

    </div>

    <!-- Botón cerrar sesión -->
    <div class="mt-8 text-center">
        <a href="/main" class="text-cyan-400 hover:text-cyan-300">
            Cerrar sesión
        </a>
    </div>

</div>

</body>
</html>