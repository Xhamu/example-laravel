<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index() {
        return view('usuarios.index');
    }

    public function crear() {
        return view('usuarios.crear');
    }

    public function mostrar($id) {
        return view('usuarios.mostrar', ['id' => $id]);
    }
}
