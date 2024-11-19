@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2 class="mb-3">Lista de facturas</h2>
        <a href="{{ route('invoices.create') }}" class="btn btn-success mb-3">Agregar nueva factura</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha de Pago</th>
                    <th>Método de Pago</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->payment_date }}</td>
                        <td>{{ $invoice->payment_method }}</td>
                        <td>{{ $invoice->state }}</td>
                        <td>
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay facturas disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
