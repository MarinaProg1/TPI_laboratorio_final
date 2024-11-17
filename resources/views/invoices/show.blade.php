@extends('layouts.app')

@section('content')
    <h1>Detalles de la Factura #{{ $invoice->id }}</h1>
    <p>Fecha de Pago: {{ $invoice->payment_date }}</p>
    <p>Método de Pago: {{ $invoice->payment_method }}</p>
    <p>Estado: {{ $invoice->state }}</p>
    <p>Carrito Asociado: #{{ $invoice->cart->id ?? 'N/A' }}</p>
@endsection
