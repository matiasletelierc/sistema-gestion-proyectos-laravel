@extends('layouts.app')

@section('title', 'Obtener Proyecto')

@section('content')
    <h2 class="text-center text-info-emphasis">Proyecto seleccionado {{ $proyecto['id'] }}</h2>
    <div class="card mb-3">
            <p class="card-title">{{ $proyecto['nombre'] }}</p>
            <p class="card-text"><strong>Fecha de Inicio:</strong> {{ $proyecto['fechaInicio'] }}</p>
            <p class="card-text"><strong>Estado:</strong> {{ $proyecto['estado'] }}</p>
            <p class="card-text"><strong>Responsable:</strong> {{ $proyecto['responsable'] }}</p>
            <p class="card-text"><strong>Monto:</strong> ${{ number_format($proyecto['monto']) }}</p>
@endsection
