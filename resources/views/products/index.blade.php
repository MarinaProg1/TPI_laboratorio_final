@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2 class="mb-3">Productos</h2>
        @if (auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Agregar nuevo producto</a>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Contenedor de productos -->
        <div class="row">
            @forelse ($products as $product)
                <!-- Cada producto ocupa 6 columnas en pantallas medianas (2 por fila) -->
                <div class="col-md-6 col-lg-4 mb-4"> <!-- Cambia 6 o 4 según cuántas columnas desees -->
                    <div class="card" style="width: 100%;"> <!-- Asegura que ocupe toda la columna -->
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <h2 class="fs-4">Precio: ${{ number_format($product->price, 2) }}</h2>
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>

                    @if (auth()->check() && auth()->user()->role == 'admin')
                        <!-- Botón de Editar -->
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <!-- Botón de Eliminar -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    @endif

                    @if (auth()->check() && auth()->user()->role == 'user')
                        <!-- Botón de agregar al carrito -->
                        <form action="{{ route('carts.add', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No hay productos disponibles.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
