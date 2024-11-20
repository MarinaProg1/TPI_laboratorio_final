@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h1>Facturas</h1>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Nueva Factura</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha de Pago</th>
                    <th>Método de Pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->payment_date }}</td>
                        <td>{{ $invoice->payment_method }}</td>
                        <td>{{ $invoice->state }}</td>
                        <td>
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
