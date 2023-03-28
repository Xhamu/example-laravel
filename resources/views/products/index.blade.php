@extends('layout')

@section('content')
    @if (session('success'))
        <div class="col-lg-12 col-6 alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="col-lg-12 col-6 alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <h1>{{ $titulo }}</h1>
        <form method="GET" action="{{ route('usuarios.index') }}">
            <div class="d-flex justify-content-between">
                <div>
                    @if ($usuarioActual->hasRole('admin'))
                        <a href="/productos/crear" class="btn btn-primary">Crear nuevo producto</a>
                    @endif
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered text-center border-dark">
                        <thead>
                            <tr>
                                <th>ID Producto
                                    <a href="{{ route('products.index', ['sort' => 'id']) }}"><i
                                            class="bi bi-arrow-up"></i></a>
                                    <a href="{{ route('products.index', ['sort' => '-id']) }}"><i
                                            class="bi bi-arrow-down"></i></a>
                                </th>
                                <th>
                                    Nombre
                                    <a href="{{ route('products.index', ['sort' => 'name']) }}"><i
                                            class="bi bi-arrow-up"></i></a>
                                    <a href="{{ route('products.index', ['sort' => '-name']) }}"><i
                                            class="bi bi-arrow-down"></i></a>
                                </th>
                                <th>
                                    Precio
                                    <a href="{{ route('products.index', ['sort' => 'price']) }}"><i
                                            class="bi bi-arrow-up"></i></a>
                                    <a href="{{ route('products.index', ['sort' => '-price']) }}"><i
                                            class="bi bi-arrow-down"></i></a>
                                </th>
                                <th>Stock
                                    <a href="{{ route('products.index', ['sort' => 'stock']) }}"><i
                                            class="bi bi-arrow-up"></i></a>
                                    <a href="{{ route('products.index', ['sort' => '-stock']) }}"><i
                                            class="bi bi-arrow-down"></i></a>
                                </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->name }}</td>
                                    <td>{{ $producto->price }}</td>
                                    <td>{{ $producto->stock }}</td>
                                    <td>
                                        @if ($usuarioActual->hasRole('editor') || $usuarioActual->hasRole('admin'))
                                            <a href="/productos/{{ $producto['id'] }}"
                                                class="btn btn-outline-primary">Pedir
                                                producto</a>
                                        @endif
                                        @if ($usuarioActual->hasRole('editor') || $usuarioActual->hasRole('admin'))
                                            <a href="/productos/editar/{{ $producto['id'] }}"
                                                class="btn btn-outline-success disabled"><i class="bi bi-pencil"></i></a>
                                        @endif
                                        @if ($usuarioActual->hasRole('admin'))
                                            <form action="/productos/delete/{{ $producto['id'] }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xl btn-outline-danger disabled"
                                                    onclick="return confirm('¿Está seguro de eliminar {{ $producto->name }}?')"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <div style="display: flex; justify-content: center; align-items: center;">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($productos->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{ $productos->previousPageUrl() }}">Anterior</a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $productos->lastPage(); $i++)
                        <li class="page-item @if ($i == $productos->currentPage()) active @endif"><a class="page-link"
                                href="{{ $productos->url($i) }}">{{ $i }}</a></li>
                    @endfor

                    @if ($productos->currentPage() < $productos->lastPage())
                        <li class="page-item"><a class="page-link" href="{{ $productos->nextPageUrl() }}">Siguiente</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
