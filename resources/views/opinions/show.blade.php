@extends('layouts.app')

@section('content')
    <h1>Detalles de la Opinión #{{ $opinion->id }}</h1>
    <p>Calificación: {{ $opinion->qualification }}</p>
    <p>Comentario: {{ $opinion->comment }}</p>
    <p>Fecha: {{ $opinion->date }}</p>
    <p>Usuario: {{ $opinion->user->name ?? 'N/A' }}</p>
    <p>Producto: {{ $opinion->product->name ?? 'N/A' }}</p>
@endsection
