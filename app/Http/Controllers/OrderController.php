<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pedirProducto1($id)
    {
        $producto = Product::findOrFail($id);

        if (is_null($producto)) {
            return view('errores.404');
        }

        $usuario = Auth::user();

        $pedido = new Order();
        $pedido->product_id = $producto->id;
        $pedido->user_id = $usuario->id;
        $pedido->save();

        return redirect()->route('products.index')->with('success', 'Producto pedido con éxito.');
    }

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

        $pedido = new Order();
        $pedido->product_id = $producto->id;
        $pedido->user_id = Auth::id();
        $pedido->cantidad = $cantidad;
        $pedido->save();

        $producto->stock -= $cantidad;
        $producto->save();

        return redirect()->route('products.index')->with('success', 'Pedido realizado con éxito.');
    }
}
