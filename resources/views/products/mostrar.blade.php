@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Producto ID: {{ $producto->id }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Imagen del producto:</label>
                            <div class="col-md-6">
                                <img width="200px" src="{{ asset('storage/' . $producto->image) }}" alt="Example image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $producto->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción del
                                producto:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $producto->description }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock" class="col-md-4 col-form-label text-md-right">Stock:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $producto->stock }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Precio:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $producto->price }}</p>
                            </div>
                        </div>

                        <form action="{{ route('products.order', $producto->id) }}" method="POST"
                            onsubmit="confirm('¿Estas seguro de pedir {{ $producto->name }}?')">
                            @csrf
                            <div class="form-group row">
                                <label for="cantidad" class="col-md-4 col-form-label text-md-right">Cantidad:</label>
                                <div class="col-md-6">
                                    <input type="number" id="cantidad" name="cantidad" class="form-control" min="1"
                                        max="{{ $producto->stock }}" required value="1">
                                </div>
                            </div>
                            @if ($errors->has('cantidad'))
                                <p class="small text-danger">{{ $errors->first('cantidad') }}</p>
                            @endif
                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-4 offset-md-4">COMPRAR PRODUCTO</button>
                            </div>
                        </form>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/productos" class="btn btn-secondary">Volver al Listado de Producto</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
