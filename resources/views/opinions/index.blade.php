@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h1>Opiniones</h1>
        <a href="{{ route('opinions.create') }}" class="btn btn-primary mb-3">Nueva Opinión</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Calificación</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opinions as $opinion)
                    <tr>
                        <td>{{ $opinion->id }}</td>
                        <td>{{ $opinion->qualification }}</td>
                        <td>{{ $opinion->comment }}</td>
                        <td>{{ $opinion->date }}</td>
                        <td>{{ $opinion->product->name }}</td>
                        <td>{{ $opinion->user->name }}</td>
                        <td>
                            <a href="{{ route('opinions.show', $opinion->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('opinions.edit', $opinion->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('opinions.destroy', $opinion->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
