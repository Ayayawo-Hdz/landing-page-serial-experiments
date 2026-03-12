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

<x-layouts.app title="Registro">
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="w-96 p-8 rounded-xl shadow-xl text-white">

            <div class="flex justify-center mb-6">
                <img src="{{ asset('navi.png') }}" class="w-24">
            </div>

            <h1 class="text-2xl font-bold text-center mb-6 text-black dark:text-white">
                Crear cuenta
            </h1>

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
                    <x-input
                        class="text-black dark:text-white"
                        label="Nombre"
                        name="name"
                        placeholder="Tu nombre"
                        required
                    />
                </div>

                <div class="mb-4">
                    <x-input
                        class="text-black dark:text-white"
                        label="Correo"
                        name="email"
                        type="email"
                        placeholder="correo@ejemplo.com"
                        required
                    />
                </div>

                <div class="mb-4">
                    <x-input
                        class="text-black dark:text-white"
                        label="Contraseña"
                        name="password"
                        type="password"
                        required
                    />
                </div>

                <div class="mb-4">
                    <x-input
                        class="text-black dark:text-white"
                        label="Confirmar contraseña"
                        name="password_confirmation"
                        type="password"
                        required
                    />
                </div>

                <x-button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-500 active:scale-95 text-white font-semibold py-2.5 rounded-xl transition-all duration-200">
                    Crear cuenta
                </x-button>

                <p class="text-center mt-4 text-sm">
                    ¿Ya tienes cuenta?
                    <a href="/login" class="text-cyan-400 hover:text-cyan-300">Iniciar sesión</a>
                </p>
            </form>

        </div>
    </div>
</x-layouts.app>