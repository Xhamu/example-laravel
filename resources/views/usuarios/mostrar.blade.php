@extends('layout')

@section('title', "Usuario {{ $usuario->id }}")

@section('content')
    <br />
    <br />
    <br />
    <h1>Usuario ID: {{ $usuario->id }}</h1>
    <p>Nombre: {{ $usuario->nombre }}</p>
    <p>Email: {{ $usuario->email }}</p>
    <p>Fecha: {{ $usuario->fecha }}</p>
    <p>Profesion: {{ $usuario->titulo }}</p>
    <p><a href="/usuarios">Volver al listado de usuarios</a></p>
@endsection
