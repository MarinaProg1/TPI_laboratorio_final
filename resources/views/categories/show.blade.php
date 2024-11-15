@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $category->name }}</h2>
        <p><strong>Descripción:</strong> {{ $category->description }}</p>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
