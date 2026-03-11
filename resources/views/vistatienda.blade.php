<!DOCTYPE html>
<html>
<head>
    <title>Mi tienda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800">

<div class="w-[1000px] p-8 bg-slate-800 rounded-xl shadow-xl text-white">

    <!-- Barra superior -->
    <div class="flex justify-between mb-6">

        <a href="/carrito"
           class="bg-green-600 hover:bg-green-500 px-4 py-2 rounded">
           Ver carrito
        </a>

        <a href="/"
           class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">
           Logout
        </a>

    </div>

    <div class="flex justify-center mb-6">
        <img src="/logo.png" class="w-24">
    </div>

    <h1 class="text-2xl font-bold text-center mb-8">
        Bienvenido a la tienda
    </h1>


    <!-- CATEGORIAS -->
    @foreach($categorias as $categoria)

        <h2 class="text-xl font-bold mt-8 mb-4 text-cyan-400">
            {{ $categoria->name }}
        </h2>

        <div class="grid grid-cols-3 gap-6">

            @foreach($categoria->products as $producto)

            <div class="bg-slate-700 p-4 rounded-lg text-center">

                <img src="https://via.placeholder.com/150" class="mx-auto mb-3 rounded">

                <h2 class="font-bold">
                    {{ $producto->name }}
                </h2>

                <p class="text-slate-300 text-sm mb-2">
                    {{ $producto->description }}
                </p>

                <p class="text-cyan-400 mb-3">
                    ${{ $producto->price }}
                </p>

                <form action="/agregar-carrito" method="POST">
                    @csrf

                    <input type="hidden" name="nombre" value="{{ $producto->name }}">
                    <input type="hidden" name="precio" value="{{ $producto->price }}">

                    <x-mary-button class="bg-cyan-600 hover:bg-cyan-500 text-white w-full">
                        Comprar
                    </x-mary-button>

                </form>

            </div>

            @endforeach

        </div>

    @endforeach


</div>

</body>
</html>