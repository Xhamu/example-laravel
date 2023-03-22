@extends('layout')

@section('content')
    <h1>Pedidos del usuario {{ $pedidos[0]->user_id }}</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Usuario</th>
                <th>Producto</th>
                <th>Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->user_id }}</td>
                    <td>
                        @if ($pedido->products->isNotEmpty())
                            @foreach ($pedido->products as $product)
                                {{ $product->name }} - {{ $product->description }}<br>
                            @endforeach
                        @else
                            Sin productos
                        @endif
                    </td>
                    <td>{{ $pedido->created_at }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
