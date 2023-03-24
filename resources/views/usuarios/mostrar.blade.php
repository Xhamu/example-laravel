@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Usuario ID: {{ $usuario->id }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $usuario->nombre }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $usuario->email }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">Fecha de Nacimiento:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($usuario->fecha)->format('d-m-Y') }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_profesion" class="col-md-4 col-form-label text-md-right">Profesión:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $usuario->titulo }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_profesion" class="col-md-4 col-form-label text-md-right">Rol:</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $roleName }}</p>
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/usuarios" class="btn btn-secondary">Volver al Listado de Usuarios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
