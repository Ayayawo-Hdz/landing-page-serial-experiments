<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;

//Route::view('/', 'welcome')->name('home');

//Route::middleware(['auth', 'verified'])->group(function () {
//    Route::view('dashboard', 'dashboard')->name('dashboard');
//});

require __DIR__.'/settings.php';


Route::view('/', 'main')->name('main');
Route::view('/register', 'auth.register');


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

Route::get('/vistatienda', function () {

    $categorias = Categoria::with('products')->get();

    return view('vistatienda', compact('categorias'));

});

Route::post('/login', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        return redirect('/vistatienda');
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas'
    ]);
});

Route::post('/agregar-carrito', function(Request $request){

    $producto = [
        "nombre" => $request->nombre,
        "precio" => $request->precio
    ];

    $carrito = session()->get('carrito', []);

    $carrito[] = $producto;

    session()->put('carrito', $carrito);

    return redirect('/carrito');
});

Route::get('/carrito', function(){
    $carrito = session()->get('carrito', []);
    return view('carrito', compact('carrito'));
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

    return "Datos creados correctamente";

});