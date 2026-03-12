<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('navi.png') }}" type="image/png">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="min-h-screen font-sans antialiased bg-base-100 text-base-content">
    <x-nav sticky full-width class="bg-base-200/80 backdrop-blur-sm border-b border-base-300/50">
 
        <x-slot:brand>
            <div class="ml-5 flex items-center gap-2" onclick="window.location='/'" style="cursor: pointer;">
                <img src="{{ asset('navi.png') }}" alt="Navi Logo" class="h-10 w-10 object-contain mr-3" />
                <p class="font-bold" style="font-size: 1.5rem;">Serial Experiments Enterprises</p>
            </div>
        </x-slot:brand>

        <x-slot:actions>
            
            @if(session('autenticado'))
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-circle" title="Cerrar sesión">
                        <x-icon name="o-arrow-right-on-rectangle" class="w-6 h-6" />
                    </button>
                </form>
                <a href="/tienda" class="btn btn-ghost btn-circle" title="Tienda" >
                    <x-icon name="o-shopping-bag" class="w-6 h-6" />
                </a>
                <a href="/carrito" class="btn btn-ghost btn-circle" title="Carrito">
                    <x-icon name="o-shopping-cart" class="w-6 h-6" />
                </a>
                
            @else
                <a href="/login" class="btn btn-ghost btn-circle" title="Iniciar sesión">
                    <x-icon name="o-user" class="w-6 h-6"/>
                </a>
            @endif
            <x-theme-toggle class="btn btn-circle" />
        </x-slot:actions>

    </x-nav>
 
    <x-main full-width>
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>
 
    <x-toast />

    @if(session('carrito_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                if (typeof window.toast === 'function') {
                    window.toast({
                        toast: {
                            position: 'toast-top toast-center', 
                            css: 'alert-success text-white',
                            icon: '',
                            title: '¡Producto añadido!',
                            description: @json(session('carrito_success')),
                            timeout: 3000
                        }
                    });
                }
            }, 200);
        });
    </script>
    @endif

</body>

</html>
