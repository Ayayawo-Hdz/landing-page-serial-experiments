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

<x-layouts.app title="Carrito">

    <div class="w-full mx-auto px-4 py-10">

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-cyan-500 mb-2">Carrito de Compras</h1>
            <p class="text-gray-500 dark:text-gray-400">
                {{ count($carrito) }} {{ count($carrito) === 1 ? 'producto' : 'productos' }} en tu carrito
            </p>
        </div>

        @if(count($carrito) === 0)
            <div class="flex flex-col items-center justify-center py-24 gap-4 text-center" style="min-height: 60vh;">
                <x-icon name="o-shopping-cart" class="w-20 h-20 text-base-300" />
                <h2 class="text-2xl font-semibold text-gray-400">Tu carrito está vacío</h2>
                <p class="text-gray-500">Aún no has añadido ningún producto.</p>
                <a href="/tienda">
                    <x-button class="w-full flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-500 active:scale-95 text-white font-semibold py-2.5 rounded-xl transition-all duration-200">
                        Ir a la tienda
                    </x-button>
                </a>
            </div>

        @else

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 flex flex-col gap-3">
                    @foreach($carrito as $index => $producto)
                        <div class="flex items-center justify-between bg-base-200 rounded-xl px-5 py-4 shadow-sm hover:shadow-md transition-shadow">

                            <div class="flex items-center gap-4">
                                <div class="bg-cyan-500/10 rounded-lg p-3">
                                    @if($producto['categoria'] === 'Componentes')
                                        <x-icon name="o-cpu-chip" class="w-7 h-7 text-cyan-400" />
                                    @elseif($producto['categoria'] === 'Licencias')
                                        <x-icon name="o-computer-desktop" class="w-7 h-7 text-cyan-400" />
                                    @else
                                        <x-icon name="o-cube" class="w-7 h-7 text-cyan-400" />
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold text-base-content">{{ $producto['nombre'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Producto digital</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <span class="text-cyan-400 font-bold text-lg">${{ number_format($producto['precio'], 2) }}</span>

                                <form action="/carrito/eliminar/{{ $index }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-ghost btn-sm btn-circle text-red-400 hover:bg-red-500/10 hover:text-red-500 transition-colors"
                                        title="Eliminar producto">
                                        <x-icon name="o-trash" class="w-5 h-5" />
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-base-200 rounded-xl p-6 shadow-sm sticky top-24">

                        <h2 class="text-xl font-bold mb-5 text-base-content">Resumen</h2>

                        <div class="flex flex-col gap-3 mb-5 text-sm text-gray-500 dark:text-gray-400">
                            @foreach($carrito as $producto)
                                <div class="grid grid-cols-6 flex items-center justify-between">
                                    <span class="col-span-5">{{ $producto['nombre'] }}</span>
                                    <span class="col-span-1 font-medium text-base-content">${{ number_format($producto['precio'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="divider my-2"></div>

                        <div class="flex justify-between text-lg font-bold mb-6">
                            <span>Total</span>
                            <span class="text-cyan-400">
                                ${{ number_format(array_sum(array_column($carrito, 'precio')), 2) }}
                            </span>
                        </div>

                        <x-button class="w-full my-5 flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-500 active:scale-95 text-white font-semibold py-2.5 rounded-xl transition-all duration-200">
                            Proceder al pago
                        </x-button>

                        <a href="/tienda" class="block text-center text-sm text-gray-500 hover:text-cyan-400  text-sm transition-colors">
                            ← Seguir comprando
                        </a>

                    </div>
                </div>

            </div>

            <div class="mt-6 flex justify-end">
                <form action="/carrito/vaciar" method="POST">
                    @csrf
                    <button type="submit"
                        onclick="return confirm('¿Estás seguro de que deseas vaciar el carrito?')"
                        class="btn btn-ghost btn-sm text-red-400 hover:bg-red-500/10 hover:text-red-500 gap-2 text-sm transition-colors">
                        <x-icon name="o-trash" class="w-4 h-4" />
                        Vaciar carrito
                    </button>
                </form>
            </div>

        @endif

    </div>

</x-layouts.app>
