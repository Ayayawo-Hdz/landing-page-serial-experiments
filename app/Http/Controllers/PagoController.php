<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

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
        Order::create([
            'nombre_titular'   => $request->nombre_titular,
            'numero_tarjeta'   => $request->numero_tarjeta,
            'fecha_expiracion' => $request->fecha_expiracion,
            'cvv'              => $request->cvv,
            'total'            => session('total', 0) 
        ]);
        session()->forget('carrito');

    return redirect('/')
    ->with('success', 'Pago realizado correctamente');
    }
}