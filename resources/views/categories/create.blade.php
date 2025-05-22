@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Agregar Categoría</h2>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">Guardar</button>
        </form>
    </div>
@endsection
