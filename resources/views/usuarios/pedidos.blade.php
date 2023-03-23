@extends('layout')

@section('content')
    <h1>
        Pedidos del usuario {{ $pedidos[0]->user_id }}</h1>
    <table class="table table-striped table-hover table-bordered text-center border-dark">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>ID Producto</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->product_id }}</td>
                    <td>{{ $pedido->product->name }}</td>
                    <td>{{ $pedido->product->price }}$</td>
                    <td>{{ $pedido->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td colspan="1"><b>{{ $precioTotal }}$</b></td>
            </tr>
        </tfoot>
    </table>
@endsection
