@extends('layouts.app-new')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Lista</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalle</li>
        </ol>
    </nav>
    <div class="card mb-3" style="max-width: 900px;">

        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start"
                    alt="{{ $product->name }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title text-center">Detalle del producto</h5></br>
                    <h5 class="card-title">{{ $product->name }}</h5></br>
                    <p class="card-text">{{ $product->description }}</p>
                    <h4 class="card-title">{{ "$" . number_format($product->price, 2, ',', '.') }}</h4>

                    <h4 class="card-title">Stock diponible:{{ $product->stock }}</h4></br></br>

                    @if (auth()->check() && auth()->user()->role == 'user')
                        <!-- Botón de agregar al carrito -->
                        <form action="{{ route('carts.add', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">

                                <i class="fas fa-cart-plus fa-3x"></i>

                            </button>
                        </form>
                    @endif

                    <!-- Mostrar opiniones -->
                    <div class="mt-4">
                        <h5>Opiniones</h5>
                        @forelse ($product->opinions as $opinion)
                            <div class="opinion mb-3">
                                <strong>{{ $opinion->user->name }}</strong>
                                <p>
                                    Calificación:
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="bi bi-star{{ $i <= $opinion->qualification ? '-fill text-warning' : '' }}"></i>
                                    @endfor
                                </p>
                                <p>{{ $opinion->comment }}</p>
                                <small>Fecha: {{ \Carbon\Carbon::parse($opinion->date)->format('d/m/Y') }}</small>
                            </div>
                            <hr>
                        @empty
                            <p>No hay opiniones para este producto.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
