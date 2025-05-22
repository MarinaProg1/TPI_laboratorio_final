@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Estado de la Factura</h2>

        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <select name="state" id="state" class="form-select" required>
                    <option value="pendiente" {{ $invoice->state == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="pagado" {{ $invoice->state == 'pagado' ? 'selected' : '' }}>Pagado</option>
                    <option value="cancelado" {{ $invoice->state == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
