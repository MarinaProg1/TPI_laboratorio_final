@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2>Factura ID: {{ $invoices->id }}</h2>
        <p><strong>Fecha de Pago:</strong> {{ $invoices->payment_date }}</p>
        <p><strong>Método de Pago:</strong> {{ $invoices->payment_method }}</p>
        <p><strong>Estado:</strong> {{ $invoices->state }}</p>
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
