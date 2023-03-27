<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', HomeController::class);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/user', function () {
        return Auth::user();
    });

    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

    Route::get('/usuarios/crear', [UsuarioController::class, 'crear'])->name('usuarios.crear')
        ->middleware('role:admin');

    Route::post('/usuarios', [UsuarioController::class, 'add'])->name('usuarios.add')
        ->middleware('role:admin');

    Route::get('/usuarios/{id}', [UsuarioController::class, 'mostrar'])
        ->where('id', '[0-9]+')
        ->name('usuarios.mostrar')
        ->middleware('role:admin');

    Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'editar'])
        ->where('id', '[0-9]+')
        ->name('usuarios.editar');

    Route::put('/usuarios/update/{id}', [UsuarioController::class, 'update'])
        ->where('id', '[0-9]+')
        ->name('usuarios.update');

    Route::delete('/usuarios/delete/{id}', [UsuarioController::class, 'delete'])
        ->where('id', '[0-9]+')
        ->name('usuarios.delete')
        ->middleware('role:admin');

    Route::get('/usuarios/{id}/pedidos', [UsuarioController::class, 'pedidos'])
        ->where('id', '[0-9]+')
        ->name('usuarios.pedidos')
        ->middleware('role:admin');


    Route::get('/productos', [ProductController::class, 'index'])->name('products.index');

    Route::fallback(function () {
        return view('errores.404');
    });

    Route::get('/productos/crear', [ProductController::class, 'crear'])
        ->name('products.crear')
        ->middleware('role:admin');

    Route::delete('/productos', [ProductController::class, 'delete'])->name('products.delete');
});
