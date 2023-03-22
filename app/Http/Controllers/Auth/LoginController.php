<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
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
            session(['nombre' => $user->nombre]);
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
}
