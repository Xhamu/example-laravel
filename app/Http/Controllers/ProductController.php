<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Profesion;
use App\Models\Role;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::all();

        return view('products.index', ['productos' => $productos]);
    }

    public function crear()
    {
        return view('products.crear');
    }
}
