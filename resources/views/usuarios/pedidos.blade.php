@extends('layout')

@section('content')
    <h1>
        Pedidos del usuario {{ $pedidos[0]->user_id }}</h1>
    <table class="table table-striped table-hover table-bordered text-center border-dark">
        <thead>
            <tr>
                <th class="border border-dark">Image</th>
                <th class="border border-dark">ID Pedido</th>
                <th class="border border-dark">Producto</th>
                <th class="border border-dark">Precio</th>
                <th class="border border-dark">Fecha de pedido</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td class="border border-dark"><img src="{{ asset('images/products/' . $pedido->product->image) }}"
                            alt="Example image"></td>
                    <td class="border border-dark">{{ $pedido->id }}</td>
                    <td class="border border-dark">{{ $pedido->product->name }}</td>
                    <td class="border border-dark">{{ $pedido->product->price }}$</td>
                    <td class="border border-dark">{{ Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i:s') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="border border-dark"></td>
                <td colspan="1" class="border border-dark"><b>Precio Total</b></td>
            </tr>
            <tr>
                <td colspan="3" class="border border-dark"></td>
                <td colspan="1" class="border border-dark"><b>{{ $precioTotal }}$</b></td>
            </tr>
        </tfoot>
    </table>
@endsection
