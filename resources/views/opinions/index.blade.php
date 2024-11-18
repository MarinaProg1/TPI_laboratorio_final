@extends('layouts.app')

@section('content')
    <h1>Opiniones</h1>
    @if($opinions->isEmpty())
        <p>No hay opiniones disponibles.</p>
    @else
        <ul>
            @foreach($opinions as $opinion)
                <li>
                    <a href="{{ route('opinions.show', $opinion->id) }}">Opinión #{{ $opinion->id }}</a> - Calificación: {{ $opinion->qualification }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
