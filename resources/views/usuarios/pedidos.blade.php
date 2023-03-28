@extends('layout')

@section('content')
    @if (empty($pedidos[0]))
        <h1>El usuario no tiene pedidos</h1>
    @else
        <h1>Pedidos del usuario {{ $pedidos[0]->user_id }}</h1>
    @endif


    @if (!empty($pedidos[0]))
        <table class="table table-striped table-hover table-bordered text-center border-dark">
            <thead>
                <tr>
                    <th class="border border-dark">Imagen del producto</th>
                    <th class="border border-dark">ID Pedido</th>
                    <th class="border border-dark">Producto</th>
                    <th class="border border-dark">Precio</th>
                    <th class="border border-dark">Cantidad</th>
                    <th class="border border-dark">Fecha de pedido</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td class="border border-dark"><img width="200px"
                                src="{{ asset('storage/' . $pedido->product->image) }}" alt="Example image"></td>
                        <td class="border border-dark">{{ $pedido->id }}</td>
                        <td class="border border-dark">{{ $pedido->product->name }}</td>
                        <td class="border border-dark">{{ $pedido->product->price }}$</td>
                        <td class="border border-dark">{{ $pedido->cantidad }}</td>
                        <td class="border border-dark">
                            {{ Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i:s') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="border border-dark"></td>
                    <td colspan="2" class="border border-dark"><b>Precio Total</b></td>
                </tr>
                <tr>
                    <td colspan="3" class="border border-dark"></td>
                    <td colspan="2" class="border border-dark"><b>{{ $precioTotal }}$</b></td>
                </tr>
            </tfoot>
        </table>
        <form action="{{ route('usuarios.pedidos.borrar', $usuario->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Borrar todos los pedidos</button>
        </form>
    @endif
@endsection
