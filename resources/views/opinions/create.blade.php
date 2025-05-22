@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Lista</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">Detalle</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar Opinión</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <h4>Agregar Opinión sobre: {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('opinions.store') }}" method="POST">
                    @csrf

                    <!-- ID del producto (oculto) -->
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <!-- Comentario -->
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comentario</label>
                        <textarea name="comment" id="comment" rows="4" class="form-control" required>{{ old('comment') }}</textarea>
                    </div>

                    <!-- Calificación -->
                    <div class="mb-3">
                        <label for="qualification" class="form-label">Calificación</label>
                        <select name="qualification" id="qualification" class="form-select" required>
                            <option value="">Seleccione una calificación</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('qualification') == $i ? 'selected' : '' }}>
                                    {{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Botón de enviar -->
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send"></i> Enviar Opinión
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
