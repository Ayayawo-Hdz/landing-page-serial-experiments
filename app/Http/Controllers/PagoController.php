<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\MovimientoStock;

class PagoController extends Controller
{
    public function procesar(Request $request)
            {
                    $request->validate([
                        'nombre_titular'   => 'required|string|max:255',
                        'numero_tarjeta'   => 'required|string|max:19',
                        'fecha_expiracion' => 'required|string|max:5',
                        'cvv'              => 'required|string|max:4',
                    ]);
                $carrito = session()->get('carrito', []);
                $total = array_sum(array_column($carrito, 'precio'));

                DB::transaction(function () use ($carrito, $request) {

                    foreach ($carrito as $item) {

                        // 🔍 buscar producto
                        $producto = DB::table('productos')
                            ->where('nombre', $item['nombre'])
                            ->lockForUpdate()
                            ->first();

                        if (!$producto) {
                            throw new \Exception("Producto no encontrado: ".$item['nombre']);
                        }

                        $cantidad = 1;

                        $stockAnterior = $producto->stock_actual;
                        $stockNuevo = $stockAnterior - $cantidad;

                        if ($stockNuevo < 0) {
                            throw new \Exception("Stock insuficiente para ".$producto->nombre);
                        }

                        // 📉 actualizar stock
                        DB::table('productos')
                            ->where('id_producto', $producto->id_producto)
                            ->update([
                                'stock_actual' => $stockNuevo
                            ]);

                        // 📦 registrar movimiento
                        DB::table('movimientos_stock')->insert([
                            'id_producto' => $producto->id_producto,
                            'tipo_movimiento' => 'SALIDA',
                            'cantidad' => $cantidad,
                            'stock_anterior' => $stockAnterior,
                            'stock_nuevo' => $stockNuevo,
                            'referencia' => 'ECOMMERCE-'.time(),
                            'origen' => 'ECOMMERCE',
                            'usuario' => $request->nombre_titular,
                            'fecha' => now()
                        ]);
                    }
                });

                // 💳 guardar orden
                Order::create([
                    'nombre_titular'   => $request->nombre_titular,
                    'numero_tarjeta'   => $request->numero_tarjeta,
                    'fecha_expiracion' => $request->fecha_expiracion,
                    'cvv'              => $request->cvv,
                    'total'            => $total
                ]);

                session()->forget('carrito');

                return redirect('/carrito')
                    ->with('success', 'Pago realizado correctamente');
        }
}