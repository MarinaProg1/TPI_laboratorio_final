@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Factura ID: {{ $invoice->id }}</h2>
        <p><strong>Fecha de Pago:</strong> {{ $invoice->payment_date }}</p>
        <p><strong>Método de Pago:</strong> {{ $invoice->payment_method }}</p>
        <p><strong>Estado:</strong> {{ $invoice->state }}</p>
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
