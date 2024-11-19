@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Carrito ID: {{ $cart->id }}</h2>
        <p><strong>Estado:</strong> {{ $cart->state }}</p>
        <p><strong>Usuario:</strong> {{ $cart->user->name ?? 'N/A' }}</p>
        <a href="{{ route('carts.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
