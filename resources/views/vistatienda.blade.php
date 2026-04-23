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



<x-layouts.app title="Tienda">

        <div class="text-center my-8">
            <h1 class="text-4xl font-bold text-cyan-500 mb-4">
                Tienda de Tecnología Serial Experiments
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Explora nuestra selección de productos tecnológicos diseñados para ofrecer eficiencia y accesibilidad a precios bajos.
            </p>
        </div>

        @php
            // 🔥 AGRUPAR PRODUCTOS POR CATEGORÍA
            $agrupados = collect($productos)->groupBy('categoria');
        @endphp

        <div x-data="{ tabActiva: '{{ $agrupados->keys()->first() }}' }">

            <div class="flex gap-2 border-b border-base-300 mb-6 justify-center">
                @foreach($agrupados as $categoria => $items)
                    <button
                        @click="tabActiva = '{{ $categoria }}'"
                        :class="tabActiva === '{{ $categoria }}'
                            ? 'border-b-2 border-cyan-500 text-cyan-500 font-bold'
                            : 'text-gray-500 hover:text-cyan-400'"
                        class="px-4 py-2 transition-colors">
                        {{ $categoria ?? 'Sin categoría' }}
                    </button>
                @endforeach
            </div>

            @foreach($agrupados as $categoria => $items)
                <div x-show="tabActiva === '{{ $categoria }}'" x-cloak>
                    <div class="grid grid-cols-2 gap-6">

                        @foreach($items as $producto)
                        <div class="relative flex flex-col rounded-2xl bg-base-200 border border-base-300 hover:border-cyan-500/50 shadow-md hover:shadow-cyan-500/10 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                            <div class="h-1 w-full bg-gradient-to-r from-cyan-500 to-cyan-700"></div>

                            <div class="flex flex-col flex-1 p-6 gap-4">

                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 bg-cyan-500/10 rounded-xl p-3">
                                        <x-icon name="o-cube" class="w-7 h-7 text-cyan-400" />
                                    </div>
                                        <div class="text-left">
                                            <p class="font-bold text-lg leading-tight text-base-content">
                                                {{ $producto->nombre }}
                                            </p>
                                            <span class="text-xs text-cyan-500 font-medium tracking-wide uppercase">
                                                {{ $categoria ?? 'Sin categoría' }}
                                            </span>
                                        </div>
                                    </div>

                                <p class="text-sm text-gray-500 dark:text-gray-400 text-left leading-relaxed flex-1">
                                    Producto sincronizado con el almacén
                                </p>

                                <div class="border-t border-base-300"></div>

                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-extrabold text-cyan-400">${{ number_format($producto->precio_venta, 2) }}</span>
                                    <span class="text-xs px-2 py-1 rounded-full bg-green-500/10 text-green-400 font-medium">
                                        Stock: {{ $producto->stock_actual }}
                                    </span>
                                </div>

                                <form action="/agregar-carrito" method="POST">
                                    @csrf
                                    <input type="hidden" name="nombre" value="{{ $producto->nombre }}">
                                    <input type="hidden" name="precio" value="{{ $producto->precio_venta }}">
                                    <input type="hidden" name="categoria_nombre" value="{{ $categoria }}">
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