@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2>Generar factura</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Mostrar productos del carrito --}}
        <div class="card mb-4">
            <div class="card-header">Resumen del carrito</div>
            <div class="card-body">
                @if ($cart && $cart->products->count())
                    <ul class="list-group mb-3">
                        @foreach ($cart->products as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }} (x{{ $product->pivot->quantity ?? 1 }})
                                <span>${{ $product->price * ($product->pivot->quantity ?? 1) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <h5>Total: ${{ $cart->products->sum(fn($p) => $p->price * ($p->pivot->quantity ?? 1)) }}</h5>
                @else
                    <p>No hay productos en tu carrito.</p>
                @endif
            </div>
        </div>

        {{-- Formulario para crear factura --}}
        @if ($cart && $cart->products->count())
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="payment_date" class="form-label">Fecha de pago</label>
                    <input type="date" class="form-control @error('payment_date') is-invalid @enderror"
                        name="payment_date" value="{{ old('payment_date') }}">
                    @error('payment_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="payment_method" class="form-label">Método de pago</label>
                    <select class="form-control @error('payment_method') is-invalid @enderror" name="payment_method">
                        <option value="">Seleccionar</option>
                        <option value="Efectivo" {{ old('payment_method') == 'Efectivo' ? 'selected' : '' }}>Efectivo
                        </option>
                        <option value="Tarjeta" {{ old('payment_method') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                        <option value="Transferencia" {{ old('payment_method') == 'Transferencia' ? 'selected' : '' }}>
                            Transferencia</option>
                    </select>
                    @error('payment_method')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Podés dejar este campo oculto si querés que siempre sea "pendiente" --}}
                <input type="hidden" name="state" value="pendiente">

                <button type="submit" class="btn btn-primary">Crear factura</button>
            </form>
        @endif
    </div>
@endsection
