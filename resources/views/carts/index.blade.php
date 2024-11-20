@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h1>Carritos</h1>

        {{-- Verificar si hay datos para mostrar --}}
        @if (isset($carts) && $carts instanceof \Illuminate\Support\Collection && $carts->isNotEmpty())
            {{-- Es una colección con elementos --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td>{{ $cart->id }}</td>
                            <td>{{ $cart->state }}</td>
                            <td>{{ $cart->user->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('carts.edit', $cart->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif (isset($carts) && $carts instanceof \App\Models\Cart)
            {{-- Es un solo objeto Cart --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $carts->id }}</td>
                        <td>{{ $carts->state }}</td>
                        <td>{{ $carts->user->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('carts.edit', $carts->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('carts.destroy', $carts->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            {{-- No hay datos disponibles --}}
            <div class="alert alert-info">No hay carritos disponibles.</div>
        @endif
    </div>
@endsection
