<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $titulo = 'Listado de usuarios';

        $usuarios = Usuario::leftJoin('profesions', 'profesions.id', '=', 'usuarios.id_profesion')
            ->select('usuarios.id', 'usuarios.nombre', 'usuarios.email', 'usuarios.fecha', 'profesions.titulo')
            ->when($request->has('nombre'), function ($query) use ($request) {
                return $query->where('usuarios.nombre', 'like', '%' . $request->query('nombre') . '%');
            })
            ->when($request->has('email'), function ($query) use ($request) {
                return $query->where('usuarios.email', 'like', '%' . $request->query('email') . '%');
            })
            ->when($request->has('profesion'), function ($query) use ($request) {
                return $query->whereIn('usuarios.id_profesion', $request->query('profesion'));
            })
            ->get();

        $profesiones = Profesion::all();

        return view('usuarios.index', compact('titulo', 'usuarios', 'profesiones'));
    }


    public function crear()
    {
        $profesions = Profesion::all();

        return view('usuarios.crear', compact('profesions'));
    }

    public function mostrar($id)
    {
        $usuario = Usuario::leftJoin('profesions', 'profesions.id', '=', 'usuarios.id_profesion')
            ->select('usuarios.id', 'usuarios.nombre', 'usuarios.email', 'usuarios.fecha', 'profesions.titulo')
            ->find($id);

        if (is_null($usuario)) {
            return view('errores.404');
        }

        return view('usuarios.mostrar', compact('usuario'));
    }

    public function add()
    {
        $data = request()->validate([
            'nombre' => 'required',
            'email' => ['required', 'email', 'unique:usuarios,email'],
            'fecha' => 'required|date',
            'id_profesion' => 'required|exists:profesions,id'
        ], [
            'nombre.required' => 'El campo es obligatorio.',
            'email.required' => 'El campo es obligatorio.',
            'email.email' => 'Debe ser un formato válido.',
            'email.unique' => 'Ya existe un usuario con ese email.',
            'fecha.required' => 'El campo es obligatorio.',
            'fecha.date' => 'Debe ser una fecha válida.',
            'id_profesion.required' => 'El campo es obligatorio.',
            'id_profesion.exists' => 'La profesión seleccionada no existe.'
        ]);

        Usuario::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'fecha' => $data['fecha'],
            'id_profesion' => (int) $data['id_profesion'],
        ]);

        return redirect()->route('usuarios.index');
    }

    public function editar($id)
    {
        $titulo = 'Editar usuario';

        $usuario = Usuario::find($id);

        if (is_null($usuario)) {
            return view('errores.404');
        }

        $profesiones = Profesion::all();

        return view('usuarios.editar', compact('titulo', 'usuario', 'profesiones'));
    }

    public function update($id)
    {
        $usuario = Usuario::find($id);

        if (is_null($usuario)) {
            return view('errores.404');
        }

        $data = request()->validate([
            'nombre' => 'required',
            'email' => ['required', 'email', Rule::unique('usuarios')->ignore($usuario->id)],
            'fecha' => 'required|date',
            'id_profesion' => 'required|exists:profesions,id'
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'Debe ser un formato válido.',
            'email.unique' => 'Ya existe un usuario con ese email.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'fecha.date' => 'Debe ser una fecha válida.',
            'id_profesion.required' => 'El campo profesion es obligatorio.',
            'id_profesion.exists' => 'La profesión seleccionada no existe.'
        ]);

        $usuario->update($data);

        return redirect()->route('usuarios.index');
    }

    public function delete($id)
    {
        $usuario = Usuario::find($id);

        if (is_null($usuario)) {
            return view('errores.404');
        }

        if ($usuario->delete()) {
            $mensaje = 'Se ha borrado el usuario ' . $usuario->nombre;
            $status = 'success';
        } else {
            $mensaje = 'Se ha producido un error al eliminar el usuario.';
            $status = 'error';
        }

        return view('usuarios.index', [
            'titulo' => 'Listado de usuarios',
            'usuarios' => Usuario::all(),
            'mensaje' => $mensaje,
            'status' => $status,
        ]);
    }
}
