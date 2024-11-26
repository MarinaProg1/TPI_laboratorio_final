@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h1>Carrito</h1>

        {{-- Verificar si hay carrito y productos --}}
        @if (isset($cart) && $cart instanceof \App\Models\Cart)
            {{-- Mostrar detalles del carrito --}}
            <h3>Carrito ID: {{ $cart->id }}</h3>
            <p>Estado: {{ $cart->state }}</p>
            <p>Usuario: {{ $cart->user->name ?? 'N/A' }}</p>

            {{-- Campo oculto para el ID del carrito --}}
            @if ($products->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->price * $product->pivot->quantity }}</td>
                                <td>
                                    {{-- Botón de restar --}}
                                    <form action="{{ route('carts.update', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ $product->pivot->quantity - 1 }}">
                                        <button type="submit" class="btn btn-warning btn-sm"
                                            {{ $product->pivot->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                    </form>

                                    {{-- Botón de sumar --}}
                                    <form action="{{ route('carts.update', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ $product->pivot->quantity + 1 }}">
                                        <button type="submit" class="btn btn-success btn-sm"
                                            {{ $product->pivot->quantity >= $product->stock ? 'disabled' : '' }}>+</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Botones para seguir comprando y finalizar la compra --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">
                        Seguir comprando
                    </a>

                    <a href="{{ route('carts.checkout') }}" class="btn btn-primary btn-sm">
                        Finalizar compra
                    </a>
                </div>
            @else
                <div class="alert alert-info">Tu carrito está vacío.</div>
            @endif
        @else
            <div class="alert alert-info">No hay carritos disponibles.</div>
        @endif
    </div>
@endsection
