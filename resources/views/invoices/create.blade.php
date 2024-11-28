@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h1>Crear Factura</h1>

        {{-- Verificar si hay un carrito activo --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="payment_date">Fecha de pago</label>
                <input type="date" class="form-control" id="payment_date" name="payment_date" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Método de pago</label>
                <input type="text" class="form-control" id="payment_method" name="payment_method" required>
            </div>

            <div class="form-group">
                <label for="state">Estado</label>
                <input type="text" class="form-control" id="state" name="state" value="pendiente" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Crear Factura</button>
        </form>
    </div>
@endsection
