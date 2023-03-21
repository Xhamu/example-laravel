@extends('layout')

@section('title', 'Crear Usuario')

@section('content')
    <br />
    <br />
    <br />
    <h1>Crear usuario</h1>
    <form method="post" action="/usuarios">
        {{ csrf_field() }}

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Samuel Rodriguez" value="{{ old('nombre') }}">
        @if ($errors->has('nombre'))
            <p class="small text-danger">{{ $errors->first('nombre') }}</p>
        @endif
        <br />
        <label for="email">Correo electronico</label>
        <input type="email" name="email" id="email" placeholder="test@test.org" value="{{ old('email') }}">
        @if ($errors->has('email'))
            <p class="small text-danger">{{ $errors->first('email') }}</p>
        @endif
        <br />
        <label for="fecha">Fecha nacimiento</label>
        <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}">
        @if ($errors->has('fecha'))
            <p class="small text-danger">{{ $errors->first('fecha') }}</p>
        @endif
        <br />
        <label for="id_profesion">Profesión</label>
        <select name="id_profesion" id="id_profesion">
            <option selected value="">-- seleccione --</option>
            @foreach ($profesion as $p)
                <option value="{{ $p->id }}">{{ $p->titulo }}</option>
            @endforeach
        </select>
        <br />
        <button type="submit">Crear usuario</button>
    </form>
    <p><a href="/usuarios">Volver al listado de usuarios</a></p>
@endsection
