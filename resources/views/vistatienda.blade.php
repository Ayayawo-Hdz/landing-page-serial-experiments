@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body, .navbar, nav, [class*="nav"] {
            font-family: 'Fira Code', monospace !important;
        }
        [x-cloak] { display: none !important; }
    </style>
@endpush



<x-layouts.app title="Registro">

        <div class="text-center my-8">
            <h1 class="text-4xl font-bold text-cyan-500 mb-4">
                Tienda de Tecnología Serial Experiments
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Explora nuestra selección de productos tecnológicos diseñados para ofrecer eficiencia y accesibilidad a precios bajos.
            </p>
        </div>

        <div x-data="{ tabActiva: '{{ $categorias->first()->name }}' }">

            <div class="flex gap-2 border-b border-base-300 mb-6 justify-center">
                @foreach($categorias as $categoria)
                    <button
                        @click="tabActiva = '{{ $categoria->name }}'"
                        :class="tabActiva === '{{ $categoria->name }}'
                            ? 'border-b-2 border-cyan-500 text-cyan-500 font-bold'
                            : 'text-gray-500 hover:text-cyan-400'"
                        class="px-4 py-2 transition-colors">
                        {{ $categoria->name }}
                    </button>
                @endforeach
            </div>

            @foreach($categorias as $categoria)
                <div x-show="tabActiva === '{{ $categoria->name }}'" x-cloak>
                    <div class="grid grid-cols-2 gap-6">

                        @foreach($categoria->products as $producto)
                        <div class="relative flex flex-col rounded-2xl bg-base-200 border border-base-300 hover:border-cyan-500/50 shadow-md hover:shadow-cyan-500/10 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                            <div class="h-1 w-full bg-gradient-to-r from-cyan-500 to-cyan-700"></div>

                            <div class="flex flex-col flex-1 p-6 gap-4">

                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 bg-cyan-500/10 rounded-xl p-3">
                                        @if($categoria->name === 'Componentes')
                                            <x-icon name="o-cpu-chip" class="w-7 h-7 text-cyan-400" />
                                        @elseif($categoria->name === 'Licencias')
                                            <x-icon name="o-computer-desktop" class="w-7 h-7 text-cyan-400" />
                                        @else
                                            <x-icon name="o-cube" class="w-7 h-7 text-cyan-400" />
                                        @endif
                                    </div>
                                    <div class="text-left">
                                        <p class="font-bold text-lg leading-tight text-base-content">{{ $producto->name }}</p>
                                        <span class="text-xs text-cyan-500 font-medium tracking-wide uppercase">{{ $categoria->name }}</span>
                                    </div>
                                </div>

                                <p class="text-sm text-gray-500 dark:text-gray-400 text-left leading-relaxed flex-1">
                                    {{ $producto->description }}
                                </p>

                                <div class="border-t border-base-300"></div>

                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-extrabold text-cyan-400">${{ number_format($producto->price, 2) }}</span>
                                    <span class="text-xs px-2 py-1 rounded-full bg-green-500/10 text-green-400 font-medium">
                                        Stock: {{ $producto->stock }}
                                    </span>
                                </div>

                                <form action="/agregar-carrito" method="POST">
                                    @csrf
                                    <input type="hidden" name="nombre" value="{{ $producto->name }}">
                                    <input type="hidden" name="precio" value="{{ $producto->price }}">
                                    <input type="hidden" name="categoria_nombre" value="{{ $categoria->name }}">
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-500 active:scale-95 text-white font-semibold py-2.5 rounded-xl transition-all duration-200">
                                        <x-icon name="o-shopping-cart" class="w-4 h-4" />
                                        Agregar al carrito
                                    </button>
                                </form>

                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            @endforeach

        </div>

</x-layouts.app>