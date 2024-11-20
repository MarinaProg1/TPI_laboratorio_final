@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2 class="mb-3">Lista de productos</h2>
        @if (auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Agregar nuevo producto</a>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                        </td>
                        <td>
                            @if (auth()->check() && auth()->user()->role == 'admin')
                                <!-- Botón de Editar con ícono -->
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <!-- Botón de Eliminar con ícono -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif

                            <!-- Botón de agregar al carrito -->
                            @if (auth()->check() && auth()->user()->role == 'user')
                                <form action="{{ route('carts.add', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-cart-plus"></i> Añadir al carrito
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay productos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
