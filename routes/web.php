<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;

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

    $credenciales = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($credenciales)) {
        $request->session()->regenerate();
        session(['autenticado' => true]);
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'
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