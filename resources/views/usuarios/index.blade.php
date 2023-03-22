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
                    <a href="/usuarios/crear" class="btn btn-primary mb-3">Crear nuevo usuario</a>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Profesión</th>
                                <th>Pedidos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->nombre }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->titulo }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($usuario->pedidos as $pedido)
                                                @if (empty($pedido->name))
                                                    <li>Sin pedidos</li>
                                                @else
                                                    <li>{{ $pedido->name }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="/usuarios/{{ $usuario['id'] }}" class="btn btn-outline-primary"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="/usuarios/editar/{{ $usuario['id'] }}" class="btn btn-outline-success"><i
                                                class="bi bi-pencil"></i></a>
                                        <form action="/usuarios/delete/{{ $usuario['id'] }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xl btn-outline-danger"
                                                onclick="return confirm('¿Está seguro de eliminar a {{ $usuario->nombre }} - {{ $usuario->email }}?')"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
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
