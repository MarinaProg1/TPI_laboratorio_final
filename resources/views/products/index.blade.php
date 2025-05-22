@extends('layouts.app')

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
                <i class="bi bi-caret-right-fill"></i>
            </button>
        </div>
    </form>


    <div>
        <h2 class="mb-3">Productos</h2>
        @if (auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Agregar nuevo producto</a>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($product->image) }}" class="card-img-top product-image" alt="producto en venta">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Precio: ${{ number_format($product->price, 2) }}</li>
                            <a href="{{ route('products.show', ['id' => $product->id]) }}" style="text-align: center"> Ver
                                más</a>
                        </ul>

                        @if (auth()->check() && auth()->user()->role == 'admin')
                            <div class="card-body">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty




                <div class="col-12 text-center">
                    <p>No hay productos disponibles.</p>
                </div>
            @endforelse
        </div>
    </div>
    <h2 class="card-title"> Categorias de productos</h2></br>
    <div class="d-flex flex-wrap gap-3">
        @foreach ($categories as $category)
            <x-categories-com :category="$category" class="card-item" />
        @endforeach
    </div>
@endsection
