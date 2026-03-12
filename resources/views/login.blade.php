@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body, .navbar, nav, [class*="nav"] {
            font-family: 'Fira Code', monospace !important;
        }
    </style>
@endpush

<x-layouts.app title="Login">
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="w-96 p-8 rounded-xl shadow-xl text-white">
            
            <div class="flex justify-center mb-6">
                <img src="../logo.png" class="w-24">
            </div>

            <h1 class="text-2xl font-bold text-center mb-6 text-black dark:text-white">
                Iniciar sesión
            </h1>

            <form method="POST" action="/login">
                @csrf

                <div class="mb-4">
                    <x-input 
                        class="text-black dark:text-white"
                        label="Correo"
                        name="email"
                        type="email"
                        placeholder="correo@ejemplo.com"
                    />
                </div>

                <div class="mb-4">
                    <x-input 
                        class="text-black dark:text-white"
                        label="Contraseña"
                        name="password"
                        type="password"
                    />
                </div>

                <x-button 
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-500 active:scale-95 text-white font-semibold py-2.5 rounded-xl transition-all duration-200">
                    Iniciar sesión
                </x-button>
                
                <p class="text-center mt-4 text-sm text-gray-500">
                    ¿No tienes cuenta?
                <a href="/register" class="text-cyan-400 hover:text-cyan-300">
                    Crear cuenta
                </a>
                </p>

            </form>

        </div>
    </div>
</x-layouts.app>