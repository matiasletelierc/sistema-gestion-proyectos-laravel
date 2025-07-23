@extends('layouts.app')

@section('title', 'Obtener todos los Proyectos')

@section('content')
    <h2 class="text-center text-info-emphasis">Lista de Proyectos</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Fecha de Inicio</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto['id'] }}</td>
                    <td>{{ $proyecto['nombre'] }}</td>
                    <td>{{ $proyecto['fechaInicio'] }}</td>
                    <td>{{ $proyecto['estado'] }}</td>
                    <td>{{ $proyecto['responsable'] }}</td>
                    <td>${{ number_format($proyecto['monto']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
