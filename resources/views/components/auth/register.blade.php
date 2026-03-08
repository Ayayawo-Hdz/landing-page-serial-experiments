<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro - Mi tienda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800">

<div class="w-96 p-8 bg-slate-800 rounded-xl shadow-xl text-white">
    
    <div class="flex justify-center mb-6">
        <img src="/logo.png" class="w-24">
    </div>

    <h1 class="text-2xl font-bold text-center mb-6">
        Crear cuenta
    </h1>

    {{-- ERRORES DE VALIDACIÓN --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-500/20 border border-red-400 rounded text-red-200">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <div class="mb-4">
            <x-mary-input
                label="Nombre"
                name="name"
                placeholder="Tu nombre"
                required
            />
        </div>

        <div class="mb-4">
            <x-mary-input
                label="Correo"
                name="email"
                type="email"
                placeholder="correo@ejemplo.com"
                required
            />
        </div>

        <div class="mb-4">
            <x-mary-input
                label="Contraseña"
                name="password"
                type="password"
                required
            />
        </div>

        <div class="mb-4">
            <x-mary-input
                label="Confirmar contraseña"
                name="password_confirmation"
                type="password"
                required
            />
        </div>

        <x-mary-button 
            type="submit"
            class="bg-cyan-600 hover:bg-cyan-500 text-white w-full">
            Crear cuenta
        </x-mary-button>

        <p class="text-center mt-4">
            ¿Ya tienes cuenta?
            <a href="/" class="text-cyan-400 hover:text-cyan-300">
                Iniciar sesión
            </a>
        </p>

    </form>

</div>

</body>
</html>