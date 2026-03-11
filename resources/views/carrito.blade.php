<!DOCTYPE html>
<html>
<head>
    <title>Carrito</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-slate-900 text-white flex justify-center items-center min-h-screen">

<div class="w-[600px] bg-slate-800 p-8 rounded-xl">

<h1 class="text-2xl font-bold mb-6 text-center">
Carrito de compra
</h1>

@foreach($carrito as $producto)

<div class="flex justify-between border-b border-slate-600 py-2">
    <span>{{ $producto['nombre'] }}</span>
    <span>${{ $producto['precio'] }}</span>
</div>

@endforeach

<div class="mt-6 text-center">
<a href="/vistatienda" class="text-cyan-400">Seguir comprando</a>
</div>

</div>

</body>
</html>