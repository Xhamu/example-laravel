@extends('layout')

@section('title', 'Crear Usuario')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Crear usuario</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="/usuarios">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Samuel Rodriguez"
                                value="{{ old('nombre') }}" class="form-control">
                            @if ($errors->has('nombre'))
                                <p class="small text-danger">{{ $errors->first('nombre') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electronico</label>
                            <input type="email" name="email" id="email" placeholder="test@test.org"
                                value="{{ old('email') }}" class="form-control">
                            @if ($errors->has('email'))
                                <p class="small text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="fecha">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="" value=""
                                class="form-control">
                            @if ($errors->has('password'))
                                <p class="small text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha nacimiento</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}"
                                class="form-control">
                            @if ($errors->has('fecha'))
                                <p class="small text-danger">{{ $errors->first('fecha') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="id_profesion">Profesión</label>
                            <select name="id_profesion" id="id_profesion" class="form-control">
                                <option selected value="">-- seleccione --</option>
                                @foreach ($profesions as $p)
                                    <option value="{{ $p->id }}">{{ $p->titulo }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_profesion'))
                                <p class="small text-danger">{{ $errors->first('id_profesion') }}</p>
                            @endif
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Crear usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <p><a href="/usuarios">Volver al listado de usuarios</a></p>
@endsection
