<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $titulo = 'Listado de usuarios';

        $usuarios = Usuario::all();

        return view('usuarios.index', compact('titulo', 'usuarios'));
    }

    public function crear()
    {
        return view('usuarios.crear');
    }

    public function mostrar($id)
    {
        return view('usuarios.mostrar', ['id' => $id]);
    }
}
