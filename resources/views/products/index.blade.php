@extends('layouts.app-new')

@section('content')
    <form action="{{ route('products.index') }}" method="GET">
        <div class="input-group mb-3">
            <!-- Select para elegir categoría -->
            <select name="category_id" class="form-control">
                <option value="">Seleccionar categoría</option>
                <option value="">Todos los productos</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- Botón de búsqueda -->
            <button class="btn btn-outline-dark" type="submit">
                <i class="fa fa-search search-icon"></i>
            </button>
        </div>
    </form>


    <div class="container">
        <h2 class="mb-3">Productos</h2>
        @if (auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Agregar nuevo producto</a>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <h2 class="fs-4">Precio: ${{ number_format($product->price, 2) }}</h2>
                            <a href="{{ route('products.show', ['id' => $product->id]) }}">Ver Detalle</a>
                        </div>
                    </div>

                    @if (auth()->check() && auth()->user()->role == 'admin')
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
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
    <h5 class="card-title"> Categorias de productos</h5></br>
    <div class="d-flex flex-wrap gap-3">
        @foreach ($categories as $category)
            <x-categories-com :category="$category" class="card-item" />
        @endforeach
    </div>
@endsection
