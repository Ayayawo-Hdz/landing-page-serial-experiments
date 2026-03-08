<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


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

Route::view('/vistatienda', 'vistatienda');

Route::post('/login', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        return redirect('/vistatienda');
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas'
    ]);
});