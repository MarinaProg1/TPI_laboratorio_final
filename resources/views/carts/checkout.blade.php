@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Checkout</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('carts.processCheckout') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="address" class="form-label">Dirección de envío</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
            </div>

            <div class="mb-3">
                <label for="payment_method" class="form-label">Método de pago</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="">Seleccionar método de pago</option>
                    <option value="credit_card">Tarjeta de crédito</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Transferencia bancaria</option>
                </select>
            </div>

            <div class="mb-3">
                <h4>Total: ${{ number_format($total, 2) }}</h4>
            </div>

            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
        </form>
    </div>
@endsection
