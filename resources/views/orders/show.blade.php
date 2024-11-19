@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Orden ID: {{ $order->id }}</h2>
        <p><strong>Fecha de Orden:</strong> {{ $order->order_date }}</p>
        <p><strong>Estado:</strong> {{ $order->state }}</p>
        <p><strong>Usuario:</strong> {{ $order->user->name ?? 'N/A' }}</p>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
