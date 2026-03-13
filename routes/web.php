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

    $categorias = Categoria::with('products')->get();

    return view('vistatienda', compact('categorias'));

});

Route::post('/login', function (Request $request) {

    // Cuenta hardcodeada para pruebas
    /*$credenciales = [
        'email'    => 'admin@serial.com',
        'password' => 'serial123',
    ];*/

    // Esto es una nacada meramente de demostración :>
    $request->email = '';
    $request->password = '';

    $credenciales = [
        'email' => '',
        'password' => '',
    ];

    if (
        $request->email === $credenciales['email'] &&
        $request->password === $credenciales['password']
    ) {
        session(['autenticado' => true]);
        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas'
    ]);
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

Route::post('/logout', function () {
    session()->forget('autenticado');
    session()->forget('carrito');
    return redirect('/');
});

Route::resource('products', ProductController::class);
Route::resource('categories', CategoriaController::class);

Route::get('/crear-datos', function () {

    // Crear categorías
    $equipos = Categoria::create([
        'name' => 'Equipos',
        'description' => 'Equipos para desarrollo de sistemas'
    ]);

    $licencias = Categoria::create([
        'name' => 'Licencias',
        'description' => 'Licencias de software empresarial'
    ]);

    $componentes = Categoria::create([
        'name' => 'Componentes',
        'description' => 'Componentes para infraestructura de sistemas'
    ]);


    // Productos EQUIPOS
    Product::create([
        'name' => 'Servidor empresarial',
        'description' => 'Servidor para sistemas integrativos',
        'price' => 5000,
        'stock' => 5,
        'categoria_id' => $equipos->id
    ]);

    Product::create([
        'name' => 'Laptop desarrollo',
        'description' => 'Laptop optimizada para programación',
        'price' => 2000,
        'stock' => 10,
        'categoria_id' => $equipos->id
    ]);

    Product::create([
        'name' => 'Estación de trabajo',
        'description' => 'PC de alto rendimiento para desarrollo',
        'price' => 3500,
        'stock' => 7,
        'categoria_id' => $equipos->id
    ]);

    Product::create([
        'name' => 'Servidor en la nube',
        'description' => 'Servidor virtual para desarrollo y pruebas',
        'price' => 1000,
        'stock' => 20,
        'categoria_id' => $equipos->id
    ]);


    // Productos LICENCIAS
    Product::create([
        'name' => 'Licencia ERP',
        'description' => 'Sistema ERP empresarial',
        'price' => 3000,
        'stock' => 50,
        'categoria_id' => $licencias->id
    ]);

    Product::create([
        'name' => 'Licencia CRM',
        'description' => 'Sistema CRM para gestión de clientes',
        'price' => 2500,
        'stock' => 50,
        'categoria_id' => $licencias->id
    ]);

    Product::create([
        'name' => 'Licencia de desarrollo',
        'description' => 'Licencia para herramientas de desarrollo',
        'price' => 1500,
        'stock' => 100,
        'categoria_id' => $licencias->id
    ]);

    Product::create([
        'name' => 'Licencia de seguridad',
        'description' => 'Licencia para software de seguridad',
        'price' => 2000,
        'stock' => 50,
        'categoria_id' => $licencias->id
    ]);


    // Productos COMPONENTES
    Product::create([
        'name' => 'API Integración',
        'description' => 'API para integración entre sistemas',
        'price' => 800,
        'stock' => 100,
        'categoria_id' => $componentes->id
    ]);

    Product::create([
        'name' => 'Módulo autenticación',
        'description' => 'Sistema de autenticación segura',
        'price' => 600,
        'stock' => 100,
        'categoria_id' => $componentes->id
    ]);

    Product::create([
        'name' => 'Plugin de análisis',
        'description' => 'Plugin para análisis de datos',
        'price' => 400,
        'stock' => 100,
        'categoria_id' => $componentes->id
    ]);

    Product::create([
        'name' => 'Componente de notificaciones',
        'description' => 'Sistema de notificaciones para aplicaciones',
        'price' => 500,
        'stock' => 100,
        'categoria_id' => $componentes->id
    ]);

    return "Datos creados correctamente";

});

Route::get('/limpiar-datos', function () {
    Product::truncate();
    Categoria::truncate();
    return "Datos limpiados correctamente";
});

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