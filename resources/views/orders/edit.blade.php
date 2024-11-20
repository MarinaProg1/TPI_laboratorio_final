@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Orden</h2>
        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="order_date" class="form-label">Fecha de la Orden</label>
                <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <select class="form-control" id="state" name="state" required>
                    <option value="pending" {{ $order->state === 'pending' ? 'selected' : '' }}>Pendiente</option>
                    <option value="completed" {{ $order->state === 'completed' ? 'selected' : '' }}>Completada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
