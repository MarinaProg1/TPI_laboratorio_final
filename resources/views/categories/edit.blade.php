@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2>Editar Categoría</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description">{{ $category->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">Actualizar</button>
        </form>
    </div>
@endsection
