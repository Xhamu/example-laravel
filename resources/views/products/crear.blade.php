@extends('layout')

@section('title', 'Crear Producto')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Crear producto</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="/productos" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" placeholder="" value="{{ old('name') }}"
                                class="form-control">
                            @if ($errors->has('name'))
                                <p class="small text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <p class="small text-danger">{{ $errors->first('description') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" name="price" id="price" placeholder="" value="{{ old('price') }}"
                                class="form-control">
                            @if ($errors->has('price'))
                                <p class="small text-danger">{{ $errors->first('price') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" id="stock" placeholder="" value="{{ old('stock') }}"
                                class="form-control">
                            @if ($errors->has('stock'))
                                <p class="small text-danger">{{ $errors->first('stock') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">Imagen del producto</label>
                            <input type="file" name="image" id="image" placeholder="" value="{{ old('image') }}"
                                class="form-control">
                            @if ($errors->has('image'))
                                <p class="small text-danger">{{ $errors->first('image') }}</p>
                            @endif
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Crear producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <p><a href="/productos">Volver al listado de productos</a></p>
@endsection
