@extends('layouts.app')

@section('content')
    <h1>Facturas</h1>
    @if($invoices->isEmpty())
        <p>No hay facturas disponibles.</p>
    @else
        <ul>
            @foreach($invoices as $invoice)
                <li>
                    <a href="{{ route('invoices.show', $invoice->id) }}">Factura #{{ $invoice->id }}</a> - Fecha de pago: {{ $invoice->payment_date }} - Estado: {{ $invoice->state }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
