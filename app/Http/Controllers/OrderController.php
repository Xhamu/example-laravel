<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pedirProducto($id)
    {
        $producto = Product::findOrFail($id);

        if (is_null($producto)) {
            return view('errores.404');
        }

        $cantidad = request()->input('cantidad');
        if ($cantidad > $producto->stock) {
            return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.']);
        }

        $saldoSuficiente = Auth::user()->saldo >= ($producto->price * $cantidad);
        if (!$saldoSuficiente) {
            return redirect()->back()->withErrors(['saldo' => 'No tienes suficiente saldo para realizar esta compra.']);
        }

        $pedido = new Order();
        $pedido->product_id = $producto->id;
        $pedido->user_id = Auth::id();
        $pedido->cantidad = $cantidad;
        $pedido->save();

        $producto->stock -= $cantidad;
        $producto->save();

        $user = Auth::user();
        $user->updateBalance($producto->price * $cantidad);

        return redirect()->route('products.index')->with('success', 'Pedido realizado con éxito.');
    }

    public function borrarPedidosUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->orders()->delete();

        return redirect()->back()->with('mensaje', 'Se han borrado todos los pedidos del usuario correctamente.');
    }
}
