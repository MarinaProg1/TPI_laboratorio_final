@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2 class="mb-3">Agregar carrito</h2>
        <form action="{{ route('carts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
