<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $titulo = 'Listado de Productos';

        $sort = $request->query('sort');

        $productos = Product::query()
            ->when($sort, function ($query) use ($sort) {
                $column = ltrim($sort, '-');
                $direction = $sort[0] == '-' ? 'desc' : 'asc';
                return $query->orderBy($column, $direction);
            }, function ($query) {
                return $query->orderBy('id', 'asc');
            })
            ->paginate(7)
            ->withQueryString();

        $usuarioActual = Auth::user();

        return view('products.index', compact('titulo', 'productos', 'usuarioActual'));
    }

    public function crear()
    {
        return view('products.crear');
    }

    public function add()
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'numeric', 'min:1'],
            'image' => ['required', 'mimes:png,jpg', 'max:2048'],
        ], [
            'name.required' => 'El campo es obligatorio.',
            'description.required' => 'El campo es obligatorio.',
            'price.required' => 'El campo es obligatorio.',
            'price.numeric' => 'Debe ser un número.',
            'price.min' => 'Debe ser mayor que cero.',
            'stock.required' => 'El campo es obligatorio.',
            'stock.numeric' => 'Debe ser un número.',
            'stock.min' => 'No se puede crear un producto sin stock.',
            'image.required' => 'El campo es obligatorio.',
            'image.mimes' => 'Debe ser un archivo de tipo png o jpg.',
            'image.max' => 'La imagen no debe ser mayor de 2048 KB.',
        ]);

        Product::create([
            'nombre' => $data['name'],
            'email' => $data['description'],
            'price' => (float) $data['price'],
            'stock' => (int) $data['stock'],
            'image' => $data['image'],
        ]);

        return redirect()->route('products.index');
    }

    public function mostrar($id)
    {
        $producto = Product::find($id);

        if (is_null($producto)) {
            return view('errores.404');
        }

        return view('products.mostrar', compact('producto'));
    }
}
