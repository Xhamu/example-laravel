@extends('layout')

@section('content')

    @isset($status)
        <div class="alert alert-success">
            <p class="">Usuario {{ $mensaje }}</p>
        </div>
    @endisset
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
                            <a href="/usuarios/{{ $usuario['id'] }}" class="btn btn-xl btn-outline-primary"><i
                                    class="bi bi-eye"></i></a>
                            <a href="/usuarios/editar/{{ $usuario['id'] }}" class="btn btn-xl btn-outline-success"><i
                                    class="bi bi-pencil"></i></a>
                            <form action="/usuarios/delete/{{ $usuario['id'] }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xl btn-outline-danger"
                                    onclick="return confirm('¿Está seguro de eliminar este usuario?')"><i
                                        class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
