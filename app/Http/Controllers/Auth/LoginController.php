<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use App\Models\Profesion;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $model = Usuario::class;
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Campo de email obligatorio.',
            'email.email' => 'Debe ser un email válido.',
            'password.required' => 'Campo contraseña obligatorio.',
            'password.min' => 'Contraseña debe ser mayor a 6 caracteres.'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session([
                'nombre' => $user->nombre,
                'saldo' => $user->saldo
            ]);
            return redirect('/');
        } else {
            return back()->withErrors(['password' => 'Inicio de sesión incorrecto.'])->withInput($request->only('email'));
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        $profesions = Profesion::all();

        $roles = Role::where('name', 'editor')->get();

        return view('register', compact('profesions', 'roles'));
    }

    public function registerPost()
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

        return redirect('/');
    }
}
