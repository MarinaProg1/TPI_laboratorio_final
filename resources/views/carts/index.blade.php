@extends('layouts.app')

@section('content')
    <h1>Carritos</h1>
    @if($carts->isEmpty())
        <p>No hay carritos disponibles.</p>
    @else
        <ul>
            @foreach($carts as $cart)
                <li>
                    <a href="{{ route('carts.show', $cart->id) }}">Carrito #{{ $cart->id }}</a> - Estado: {{ $cart->state }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
