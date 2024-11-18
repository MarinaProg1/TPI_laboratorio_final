@extends('layouts.app')

@section('content')
    <h1>Órdenes</h1>
    @if($orders->isEmpty())
        <p>No hay órdenes disponibles.</p>
    @else
        <ul>
            @foreach($orders as $order)
                <li>
                    <a href="{{ route('orders.show', $order->id) }}">Orden #{{ $order->id }}</a> - Fecha de Orden: {{ $order->order_date }} - Estado: {{ $order->state }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
