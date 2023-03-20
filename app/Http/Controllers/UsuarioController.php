<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $titulo = 'Listado de usuarios';

        $usuarios = Usuario::all();
        $profesions = Profesion::all();

        return view('usuarios.index', compact('titulo', 'usuarios', 'profesions'));
    }

    public function crear()
    {
        $profesion = Profesion::all();

        return view('usuarios.crear', compact('profesion'));
    }

    public function mostrar($id)
    {
        $usuario = Usuario::find($id);

        if(is_null($usuario)) {
            return view('errores.404');
        }

        return view('usuarios.mostrar', compact('usuario'));
    }

    public function add() {

        $data = request()->validate([
            'nombre' => 'required',
            'email' => ['required', 'email', 'unique:usuarios,email'],
            'fecha' => 'required',
        ], [
            'nombre.required' => 'El campo es obligatorio.',
            'email.required' => 'El campo es obligatorio.',
            'email.email' => 'Debe ser un formato válido.',
            'email.unique' => 'Ya existe un usuario con ese email.'
        ]);

        var_dump($data);

        Usuario::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'fecha' => $data['fecha'],
            'id_profesion' => $data['profesion'],
        ]);

        

        return redirect()->route('usuarios.index');
    }
}
