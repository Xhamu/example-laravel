@extends('layout')

@section('titulo', 'Usuarios')

@section('content')
<h1>{{ $titulo }}</h1>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Fecha</th>
    </tr>
  </thead>
    <tbody>
        @forelse ($usuarios as $user)
        <tr>
            <td>{{ $user->nombre }}</td>
            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
            <td>{{ $user->fecha }}</td>
            @empty
            <td>No hay usuarios registrados.</td>
            @endforelse
        </tr>
    </tbody>
</table>
@endsection

@section('sidebar')
@parent
@endsection