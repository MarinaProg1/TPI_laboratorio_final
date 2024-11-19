@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2 class="mb-3">Editar carrito</h2>
        <form action="{{ route('carts.update', $cart->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ $cart->state }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
