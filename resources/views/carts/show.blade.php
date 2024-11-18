@extends('layouts.app')

@section('content')
    <h1>Detalles del Carrito #{{ $cart->id }}</h1>
    <p>Estado: {{ $cart->state }}</p>
    <p>Usuario: {{ $cart->user->name ?? 'N/A' }}</p>

    <h2>Productos</h2>
    @if($cart->products->isEmpty())
        <p>El carrito no contiene productos.</p>
    @else
        <ul>
            @foreach($cart->products as $product)
                <li>{{ $product->name }} - ${{ $product->price }}</li>
            @endforeach
        </ul>
    @endif
@endsection
