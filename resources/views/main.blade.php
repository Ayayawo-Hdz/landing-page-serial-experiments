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
    <title>Mi tienda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800">
<div class="w-96 p-8 bg-slate-800 rounded-xl shadow-xl text-white">
    
    <div class="flex justify-center mb-6">
        <img src="/logo.png" class="w-24">
    </div>

    <h1 class="text-2xl font-bold text-center mb-6">
        Iniciar sesión
    </h1>

    <form method="POST" action="/login">
        @csrf

        <div class="mb-4">
            <x-mary-input 
                label="Correo"
                name="email"
                type="email"
                placeholder="correo@ejemplo.com"
            />
        </div>

        <div class="mb-4">
            <x-mary-input 
                label="Contraseña"
                name="password"
                type="password"
            />
        </div>

        <x-mary-button 
            type="submit"
            class="bg-cyan-600 hover:bg-cyan-500 text-white w-full">
            Iniciar sesión
        </x-mary-button>
        
        <p class="text-center mt-4">
            ¿No tienes cuenta?
        <a href="/register" class="text-cyan-400 hover:text-cyan-300">
            Crear cuenta
        </a>
        </p>

    </form>

</div>

</body>
</html>