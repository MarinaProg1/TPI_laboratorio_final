@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Opinión ID: {{ $opinion->id }}</h2>
        <p><strong>Calificación:</strong> {{ $opinion->qualification }}</p>
        <p><strong>Comentario:</strong> {{ $opinion->comment }}</p>
        <p><strong>Fecha:</strong> {{ $opinion->date }}</p>
        <p><strong>Usuario:</strong> {{ $opinion->user->name ?? 'N/A' }}</p>
        <p><strong>Producto:</strong> {{ $opinion->product->name ?? 'N/A' }}</p>
        <a href="{{ route('opinions.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
