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
            <form action="{{ route('carts.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="cart_id" value="{{ $cart->id }}">

                {{-- Verificar si hay productos en el carrito --}}
                @if ($products->isNotEmpty())
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
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <!-- Muestra la cantidad en la tabla intermedia -->
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->price * $product->pivot->quantity }}</td> <!-- Muestra el total -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Botones para seguir comprando y finalizar la compra --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">
                            Seguir comprando
                        </a>
                        <button type="submit" class="btn btn-success btn-sm">
                            Finalizar compra
                        </button>
                    </div>
                @else
                    <div class="alert alert-info">Tu carrito está vacío.</div>
                @endif
            </form>
        @else
            <div class="alert alert-info">No hay carritos disponibles.</div>
        @endif
    </div>
@endsection
