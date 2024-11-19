@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h2 class="mb-3">Lista de opiniones</h2>
        <a href="{{ route('opinions.create') }}" class="btn btn-success mb-3">Agregar nueva opinión</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Calificación</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($opinions as $opinion)
                    <tr>
                        <td>{{ $opinion->id }}</td>
                        <td>{{ $opinion->qualification }}</td>
                        <td>{{ $opinion->comment }}</td>
                        <td>{{ $opinion->date }}</td>
                        <td>
                            <a href="{{ route('opinions.edit', $opinion->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('opinions.destroy', $opinion->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay opiniones disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
