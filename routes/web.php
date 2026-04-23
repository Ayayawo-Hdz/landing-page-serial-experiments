<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PagoController;

require __DIR__.'/settings.php';


Route::view('/', 'components.main')->name('main');
Route::view('/register', 'register');


Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    return redirect('/');

});

Route::get('/tienda', function () {

    if (!session('autenticado')) {
        return redirect('/login')->withErrors(['email' => 'Debes iniciar sesión primero.']);
    }

    try {
        // 🔥 TRAER PRODUCTOS DESDE MYSQL (WINDOWS)
        $productos = DB::select("
            SELECT 
                p.id_producto,
                p.nombre,
                p.precio_venta,
                p.stock_actual,
                c.nombre AS categoria
            FROM productos p
            LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
            ORDER BY p.nombre
        ");

    } catch (\Exception $e) {
        return "Error de conexión: " . $e->getMessage();
    }

    return view('vistatienda', compact('productos'));
});

Route::post('/login', function (Request $request) {
// 👉 Simulación de login (sin BD)
    session(['autenticado' => true]);

    return redirect('/tienda');
   
});

Route::post('/agregar-carrito', function(Request $request){

    $producto = [
        "categoria" => $request->categoria_nombre,
        "nombre" => $request->nombre,
        "precio" => $request->precio
    ];

    $carrito = session()->get('carrito', []);

    $carrito[] = $producto;

    session()->put('carrito', $carrito);

    return redirect('/tienda')->with('carrito_success', '"' . $request->nombre . '" fue añadido al carrito correctamente.');
});

Route::get('/carrito', function(){
    if (!session('autenticado')) {
        return redirect('/login')->withErrors(['email' => 'Debes iniciar sesión primero.']);
    }
    $carrito = session()->get('carrito', []);
    return view('carrito', compact('carrito'));
});

Route::post('/logout', function (Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    session()->forget('autenticado');
    session()->forget('carrito');
    return redirect('/');
});

Route::resource('products', ProductController::class);
Route::resource('categories', CategoriaController::class);

Route::post('/carrito/eliminar/{index}', function (int $index) {
    $carrito = session()->get('carrito', []);
    array_splice($carrito, $index, 1);
    session()->put('carrito', array_values($carrito));
    return redirect('/carrito');
});

Route::post('/carrito/vaciar', function () {
    session()->forget('carrito');
    return redirect('/carrito');
});

Route::post('/pago', [PagoController::class, 'procesar']);