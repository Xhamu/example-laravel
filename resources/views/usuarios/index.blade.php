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

            <button type="submit" class="btn btn-primary"> Filtrar </button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Reiniciar Filtros</a>
            <div class="row mt-3">
                <div class="col-md-12">
                    @if ($usuarioActual->hasRole('admin'))
                        <a href="/usuarios/crear" class="btn btn-primary mb-3">Crear nuevo usuario</a>
                    @endif
                    <table class="table table-striped table-hover table-bordered text-center border-dark">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Profesión</th>
                                @if ($usuarioActual->hasRole('admin'))
                                    <th>Pedidos</th>
                                @endif
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
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
    </div>
@endsection
