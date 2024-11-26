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

                    <h4 class="card-title">Cantidad diponible:{{ $product->stock }}</h4></br></br>

                    @if (auth()->check() && auth()->user()->role == 'user')
                        <!-- Botón de agregar al carrito -->
                        <form action="{{ route('carts.add', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">

                                <i class="fas fa-cart-plus fa-3x"></i>

                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
