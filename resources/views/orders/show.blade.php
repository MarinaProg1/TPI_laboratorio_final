@extends('layouts.app')

@section('content')
    <h1>Detalles de la Orden #{{ $order->id }}</h1>
    <p>Fecha de Orden: {{ $order->order_date }}</p>
    <p>Estado: {{ $order->state }}</p>
    <p>Usuario: {{ $order->user->name ?? 'N/A' }}</p>
    <p>Carrito Asociado: #{{ $order->cart->id ?? 'N/A' }}</p>
@endsection
