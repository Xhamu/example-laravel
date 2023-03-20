<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
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

Route::get('/', HomeController::class);

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

Route::get('/usuarios/crear', [UsuarioController::class, 'crear'])->name('usuarios.crear');

Route::post('/usuarios', [UsuarioController::class, 'add']);

Route::get('/usuarios/{id}', [UsuarioController::class, 'mostrar'])
    ->where('id', '[0-9]+')
    ->name('usuarios.mostrar');
