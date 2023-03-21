@extends('layout')

@section('titulo', 'Listado de usuarios')

@section('content')
    <h1>{{ $titulo }}</h1>
    <a href="/usuarios/crear"><button>Crear nuevo usuario</button></a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha</th>
                <th>Profesión</th>
                <th>Acciones</th>
            </tr>
        </thead>
        @foreach ($usuarios as $user)
            <tbody>
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['nombre'] }}</td>
                    <td><a href="mailto:{{ $user->email }}">{{ $user['email'] }}</a></td>
                    <td>{{ $user['fecha'] }}</td>
                    <td>{{ $user['titulo'] }}</td>
                    <td><a href="/usuarios/{{ $user['id'] }}">Mostrar</a>
                        <br />
                        <a href="/usuarios/edit/{{ $user['id'] }}">Editar</a>
                        <br />
                        <a href="/usuarios/delete/{{ $user['id'] }}">Borrar</a>
                    </td>
                    @if (count($usuarios) < 0)
                        <td>No hay usuarios registrados.</td>
                    @endif
        @endforeach
        </tr>
        </tbody>
    </table>
@endsection

@section('sidebar')
    @parent
@endsection
