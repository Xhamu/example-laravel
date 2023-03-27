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
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ old('nombre', request()->query('nombre')) }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email"
                    value="{{ old('email', request()->query('email')) }}">
            </div>

            <div class="form-group">
                <label for="profesion">Profesión:</label>
                <select class="form-control" id="profesion" name="profesion[]" multiple>
                    @foreach ($profesiones as $profesion)
                        <option value="{{ $profesion->id }}" @if (in_array($profesion->id, (array) request()->query('profesion'))) selected @endif>
                            {{ $profesion->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Reiniciar Filtros</a>
                </div>
                <div>
                    @if ($usuarioActual->hasRole('admin'))
                        <a href="/usuarios/crear" class="btn btn-primary">Crear nuevo usuario</a>
                    @endif
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-bordered text-center border-dark">
                        <thead>
                            <tr>
                                <th>ID Usuario
                                    <a href="{{ route('usuarios.index', ['sort' => 'id']) }}"><i class="bi bi-arrow-up"></i></a>
                                    <a href="{{ route('usuarios.index', ['sort' => '-id']) }}"><i class="bi bi-arrow-down"></i></a>
                                </th>
                                <th>
                                    Nombre
                                    <a href="{{ route('usuarios.index', ['sort' => 'nombre']) }}"><i class="bi bi-arrow-up"></i></a>
                                    <a href="{{ route('usuarios.index', ['sort' => '-nombre']) }}"><i class="bi bi-arrow-down"></i></a>
                                </th>
                                <th>
                                    Profesión
                                    <a href="{{ route('usuarios.index', ['sort' => 'titulo']) }}"><i class="bi bi-arrow-up"></i></a>
                                    <a href="{{ route('usuarios.index', ['sort' => '-titulo']) }}"><i class="bi bi-arrow-down"></i></a>
                                </th>
                                @if ($usuarioActual->hasRole('admin'))
                                    <th>Pedidos</th>
                                @endif
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->nombre }}</td>
                                    <td>{{ $usuario->titulo }}</td>
                                    @if ($usuarioActual->hasRole('admin'))
                                        <td>
                                            @if ($usuario->pedidos->count() > 0)
                                                <a class="btn btn-secondary"
                                                    href="{{ route('usuarios.pedidos', ['id' => $usuario->id]) }}">Ver
                                                    pedidos</a>
                                            @else
                                                <p><b>Sin pedidos</b></p>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if ($usuarioActual->hasRole('admin'))
                                            <a href="/usuarios/{{ $usuario['id'] }}" class="btn btn-outline-primary"><i
                                                    class="bi bi-eye"></i></a>
                                        @endif
                                        @if ($usuarioActual->hasRole('editor') || $usuarioActual->hasRole('admin'))
                                            <a href="/usuarios/editar/{{ $usuario['id'] }}"
                                                class="btn btn-outline-success"><i class="bi bi-pencil"></i></a>
                                        @endif
                                        @if ($usuarioActual->hasRole('admin'))
                                            <form action="/usuarios/delete/{{ $usuario['id'] }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xl btn-outline-danger"
                                                    onclick="return confirm('¿Está seguro de eliminar a {{ $usuario->nombre }} - {{ $usuario->email }}?')"><i
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
                    @if ($usuarios->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{ $usuarios->previousPageUrl() }}">Anterior</a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
                        <li class="page-item @if ($i == $usuarios->currentPage()) active @endif"><a class="page-link"
                                href="{{ $usuarios->url($i) }}">{{ $i }}</a></li>
                    @endfor

                    @if ($usuarios->currentPage() < $usuarios->lastPage())
                        <li class="page-item"><a class="page-link" href="{{ $usuarios->nextPageUrl() }}">Siguiente</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
