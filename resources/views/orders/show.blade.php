@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Orden ID: {{ $order->id }}</h2>
        <p><strong>Fecha de la Orden:</strong> {{ $order->order_date }}</p>
        <p><strong>Estado:</strong> {{ $order->state }}</p>
        <p><strong>Usuario:</strong> {{ $order->user->name ?? 'N/A' }}</p>
        <p><strong>Carro Asociado:</strong> {{ $order->cart->id ?? 'N/A' }}</p>

        @if ($order->cart)
            <h4>Productos en el Carro</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->cart->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>${{ number_format($product->price * $product->pivot->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay productos asociados con este carro.</p>
        @endif

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
