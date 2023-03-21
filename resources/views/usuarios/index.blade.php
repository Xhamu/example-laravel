@extends('layout')

@section('content')
    <div class="container">
        <h1>{{ $titulo }}</h1>
        <a href="/usuarios/crear"><button>Crear nuevo usuario</button></a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha</th>
                    <th>Profesión</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->fecha }}</td>
                        <td>{{ $usuario->titulo }}</td>
                        <td>
                            <a href="/usuarios/{{ $usuario['id'] }}" class="btn btn-sm btn-outline-primary"><i
                                    class="bi bi-eye"></i> Mostrar</a>
                            <a href="/usuarios/editar/{{ $usuario['id'] }}" class="btn btn-sm btn-outline-warning"><i
                                    class="bi bi-pencil"></i> Editar</a>
                            <form action="/usuarios/delete/{{ $usuario['id'] }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('¿Está seguro de eliminar este usuario?')"><i
                                        class="bi bi-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
