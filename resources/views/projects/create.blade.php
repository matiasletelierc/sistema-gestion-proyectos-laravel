<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Crear Nuevo Proyecto</h1>
        
        @include('components.uf-component')
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('projects.store') }}" method="POST" class="project-form">
            @csrf
            <div class="form-group">
                <label for="name">Nombre del Proyecto:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="start_date">Fecha de Inicio:</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="status">Estado:</label>
                <select id="status" name="status" required>
                    <option value="">Seleccionar estado</option>
                    @foreach($statusOptions as $value => $label)
                        <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="responsible">Responsable:</label>
                <input type="text" id="responsible" name="responsible" value="{{ old('responsible') }}" required>
                @error('responsible')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="amount">Monto:</label>
                <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0" required>
                @error('amount')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Crear Proyecto</button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
