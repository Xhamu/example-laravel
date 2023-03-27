<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Profesion;
use App\Models\Role;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $titulo = 'Listado de usuarios';

        $profesiones = Profesion::all();

        $sort = $request->query('sort');

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
            ->when($sort, function ($query) use ($sort) {
                $column = ltrim($sort, '-');
                $direction = $sort[0] == '-' ? 'desc' : 'asc';
                return $query->orderBy($column, $direction);
            }, function ($query) {
                return $query->orderBy('usuarios.id', 'asc');
            })
            ->paginate(7)
            ->withQueryString();

        foreach ($usuarios as $usuario) {
            $pedidos = Order::leftJoin('products', 'products.id', '=', 'orders.product_id')
                ->select('orders.id', 'products.name', 'orders.created_at')
                ->where('orders.user_id', '=', $usuario->id)
                ->get();

            $usuario->pedidos = $pedidos;
        }

        $usuarioActual = Auth::user();

        return view('usuarios.index', compact('titulo', 'usuarios', 'profesiones', 'usuarioActual'));
    }


    public function crear()
    {
        $profesions = Profesion::all();

        $roles = Role::all();

        return view('usuarios.crear', compact('profesions', 'roles'));
    }

    public function mostrar($id)
    {
        $usuario = Usuario::leftJoin('profesions', 'profesions.id', '=', 'usuarios.id_profesion')
            ->select('usuarios.id', 'usuarios.nombre', 'usuarios.email', 'usuarios.fecha', 'profesions.titulo')
            ->find($id);

        if (is_null($usuario)) {
            return view('errores.404');
        }

        $roleName = $usuario->roles->pluck('name')->implode(', ');

        return view('usuarios.mostrar', compact('usuario', 'roleName'));
    }

    public function add()
    {
        $data = request()->validate([
            'nombre' => 'required',
            'email' => ['required', 'email', 'unique:usuarios,email'],
            'fecha' => 'required|date',
            'id_profesion' => 'required|exists:profesions,id',
            'password' => 'required|min:6',
            'roles' => 'required',
        ], [
            'nombre.required' => 'El campo es obligatorio.',
            'email.required' => 'El campo es obligatorio.',
            'email.email' => 'Debe ser un formato válido.',
            'email.unique' => 'Ya existe un usuario con ese email.',
            'fecha.required' => 'El campo es obligatorio.',
            'fecha.date' => 'Debe ser una fecha válida.',
            'id_profesion.required' => 'El campo es obligatorio.',
            'id_profesion.exists' => 'La profesión seleccionada no existe.',
            'password.required' => 'El campo es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'roles.required' => 'El campo es obligatorio.',
        ]);

        $user = Usuario::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'fecha' => $data['fecha'],
            'id_profesion' => (int) $data['id_profesion'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assignRole($data['roles']);

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

        $roles = Role::all();

        return view('usuarios.editar', compact('titulo', 'usuario', 'profesiones', 'roles'));
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
            'id_profesion' => 'required|exists:profesions,id',
            'password' => 'nullable|min:6',
            'roles' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'Debe ser un formato válido.',
            'email.unique' => 'Ya existe un usuario con ese email.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'fecha.date' => 'Debe ser una fecha válida.',
            'id_profesion.required' => 'El campo profesion es obligatorio.',
            'id_profesion.exists' => 'La profesión seleccionada no existe.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres',
            'roles.required' => 'El campo es obligatorio',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $usuario->roles()->detach();

        $usuario->assignRole($data['roles']);

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

        return redirect()->route('usuarios.index')->with($status, $mensaje);
    }

    public function pedidos($id)
    {
        $usuario = Usuario::find($id);

        $pedidos = Order::with('product')->where('user_id', $id)->get();

        if (is_null($usuario)) {
            return view('errores.404');
        }

        $precioTotal = $pedidos->sum(function ($pedido) {
            return $pedido->product->price;
        });

        return view('usuarios.pedidos', compact('pedidos', 'usuario', 'precioTotal'));
    }
}
