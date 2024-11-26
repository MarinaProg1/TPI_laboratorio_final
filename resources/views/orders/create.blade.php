@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2>Crear Nueva Orden</h2>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="order_date" class="form-label">Fecha de la Orden</label>
                <input type="date" class="form-control" id="order_date" name="order_date" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <select class="form-control" id="state" name="state" required>
                    <option value="pending">Pendiente</option>
                    <option value="completed">Completada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
