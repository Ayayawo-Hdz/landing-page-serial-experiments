<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


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

               

                    foreach ($carrito as $item) {

                        // buscar producto solo para obtener ID
                        $producto = DB::table('productos')
                            ->where('nombre', $item['nombre'])
                            ->first();

                        if (!$producto) {
                            throw new \Exception("Producto no encontrado: ".$item['nombre']);
                        }

                        $cantidad = 1;
                        $idPedido = time(); // o ID real de Order

                        // 🔥 LLAMAR STORED PROCEDURE
                        DB::statement("CALL sp_actualizar_stock_venta(?, ?, ?, @resultado)", [
                            $producto->id_producto,
                            $cantidad,
                            $idPedido
                        ]);

                        // 🔍 leer resultado
                        $resultado = DB::select("SELECT @resultado as resultado")[0]->resultado;

                        if ($resultado === 'STOCK_INSUFICIENTE') {
                            throw new \Exception("Stock insuficiente para ".$item['nombre']);
                        }
                    }
                

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