@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2 class="mb-3">Agregar factura</h2>
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="payment_date" class="form-label">Fecha de Pago</label>
                <input type="date" class="form-control" id="payment_date" name="payment_date" required>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Método de Pago</label>
                <input type="text" class="form-control" id="payment_method" name="payment_method" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
