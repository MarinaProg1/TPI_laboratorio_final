@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $product->name }}</h2>
        <p><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
        <p><strong>Descripción:</strong> {{ $product->description }}</p>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="300">
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>
@endsection
