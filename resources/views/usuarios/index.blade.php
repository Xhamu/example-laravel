@extends('layout')

@section('titulo', 'Listado de usuarios')

@section('content')
<h1>{{ $titulo }}</h1>

<table class="table table-hover">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Fecha</th>
    </tr>
  </thead>
  @forelse ($usuarios as $user)
    <tbody>
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