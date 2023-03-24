@extends('layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $titulo }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                value="{{ old('nombre', $usuario->nombre) }}">
                            @if ($errors->has('nombre'))
                                <p class="small text-danger">{{ $errors->first('nombre') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $usuario->email) }}">
                            @if ($errors->has('email'))
                                <p class="small text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="fecha">Contraseña</label>
                            <input type="password" name="password" id="password" value="" class="form-control">
                            @if ($errors->has('password'))
                                <p class="small text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" name="fecha" id="fecha" class="form-control"
                                value="{{ old('fecha', $usuario->fecha) }}">
                            @if ($errors->has('fecha'))
                                <p class="small text-danger">{{ $errors->first('fecha') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="id_profesion">Profesión:</label>
                            <select name="id_profesion" id="id_profesion" class="form-control">
                                @foreach ($profesiones as $profesion)
                                    <option value="{{ $profesion->id }}"
                                        {{ $usuario->id_profesion == $profesion->id ? 'selected' : '' }}>
                                        {{ $profesion->titulo }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_profesion'))
                                <p class="small text-danger">{{ $errors->first('id_profesion') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="roles">Roles:</label>
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="roles[]"
                                        id="role_{{ $role->id }}" value="{{ $role->id }}"
                                        {{ $usuario->hasRole($role->name) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_{{ $role->id }}">
                                        {{ ucfirst($role->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
