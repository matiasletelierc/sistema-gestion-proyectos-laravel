@extends('layouts.app')

@section('title', 'Error de Proyecto')

@section('content')
    <h2 class="text-center text-danger">Proyecto con ID '{{ $id }}' no encontrado</h2>
@endsection
