@extends('layouts.app-new')

@section('content')
    <div class="container">
        <h1>Órdenes</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Carro Asociado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->state }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ $order->cart->id ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
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
