@extends('layouts.app-new')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Lista</a></li>
                <li class="breadcrumb-item"><a href="#">Detalle</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrito</li>
            </ol>
        </nav>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li>
                    <i class="fas fa-cart-plus fa-2x"></i>
                </li>
                <li>
                    <h1>Tu carrito de compras</h1>
                </li>

            </ol>
        </nav>


        {{-- Verificar si hay carrito y productos --}}
        @if (isset($cart) && $cart instanceof \App\Models\Cart)
            {{-- Mostrar detalles del carrito --}}
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
                                <td>
                                    {{ $product->name }}<br>
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail"
                                        alt="{{ $product->name }}" style="width: 80px; height: auto;">
                                </td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>${{ number_format($product->price * $product->pivot->quantity, 2) }}</td>
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
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            {{ $product->pivot->quantity >= $product->stock ? 'disabled' : '' }}>+</button>
                                    </form>

                                    {{-- Botón de remover --}}
                                    <form action="{{ route('carts.remove', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">x</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total:</strong></td>
                            <td colspan="2">
                                ${{ number_format($products->sum(fn($product) => $product->price * $product->pivot->quantity), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>

                {{-- Botones para seguir comprando y finalizar la compra --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">
                        Seguir comprando
                    </a>

                    <a href="{{ route('invoices.store') }}" class="btn btn-primary btn-sm">
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
