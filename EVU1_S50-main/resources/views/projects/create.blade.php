<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>➕ Crear Proyecto - Gestión de Proyectos</title>
    <link rel="stylesheet" href="{{ asset('assets/css/modern-app.css') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🚀</text></svg>">
</head>
<body>
    <div class="container">
        <header class="animate-fade-in-up">
            <h1>🚀 Gestión de Proyectos</h1>
        </header>

        <nav class="animate-fade-in-up">
            <ul>
                <li><a href="{{ route('projects.index') }}">📋 Lista de Proyectos</a></li>
                <li><a href="{{ route('projects.create') }}">➕ Crear Proyecto</a></li>
                <li><a href="/uf">💰 Valor UF</a></li>
            </ul>
        </nav>

        <!-- Componente UF -->
        @include('components.uf-component')
        
        @if ($errors->any())
            <div class="alert alert-error animate-fade-in-up">
                <h4>❌ Errores en el formulario:</h4>
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="card animate-fade-in-up">
            <h2>➕ Crear Nuevo Proyecto</h2>
            
            <form action="{{ route('projects.store') }}" method="POST" class="project-form">
                @csrf
                
                <div class="grid grid-2">
                    <div class="form-group">
                        <label for="name">🏷️ Nombre del Proyecto:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ej: Sistema de Gestión">
                        @error('name')
                            <span class="error" style="color: #fecaca; font-size: 0.9rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="start_date">📅 Fecha de Inicio:</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <span class="error" style="color: #fecaca; font-size: 0.9rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-2">
                    <div class="form-group">
                        <label for="status">📊 Estado:</label>
                        <select id="status" name="status" required>
                            <option value="">🔽 Seleccionar estado</option>
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="error" style="color: #fecaca; font-size: 0.9rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="responsible">👤 Responsable:</label>
                        <input type="text" id="responsible" name="responsible" value="{{ old('responsible') }}" required placeholder="Ej: Juan Pérez">
                        @error('responsible')
                            <span class="error" style="color: #fecaca; font-size: 0.9rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="amount">💰 Monto:</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0" required placeholder="Ej: 150000">
                    @error('amount')
                        <span class="error" style="color: #fecaca; font-size: 0.9rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-actions" style="display: flex; gap: 1rem; margin-top: 2rem; justify-content: center; flex-wrap: wrap;">
                    <button type="submit" class="btn btn-primary" style="min-width: 150px;">
                        ✅ Crear Proyecto
                    </button>
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary" style="min-width: 150px; text-align: center;">
                        ❌ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Efecto de focus en inputs
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>
