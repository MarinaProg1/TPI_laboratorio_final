@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2 class="mb-3">Lista de productos</h2>
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Agregar nuevo producto</a>

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
                    <th>Accion</th>
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
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
