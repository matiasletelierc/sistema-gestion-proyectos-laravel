<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Proyecto</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Detalle del Proyecto</h1>
        
        @include('components.uf-component')
        
        <div class="project-detail">
            <div class="detail-card">
                <h2>{{ $project->name }}</h2>
                
                <div class="detail-section">
                    <h3>Información General</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <strong>Responsable:</strong>
                            <span>{{ $project->responsible }}</span>
                        </div>
                        <div class="detail-item">
                            <strong>Estado:</strong>
                            <span class="status-badge status-{{ $project->status }}">
                                {{ App\Models\Project::getStatusOptions()[$project->status] }}
                            </span>
                        </div>
                        <div class="detail-item">
                            <strong>Fecha de Inicio:</strong>
                            <span>{{ $project->start_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <strong>Monto:</strong>
                            <span>${{ number_format($project->amount, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h3>Información del Sistema</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <strong>ID del Proyecto:</strong>
                            <span>{{ $project->id }}</span>
                        </div>
                        <div class="detail-item">
                            <strong>Creado:</strong>
                            <span>{{ $project->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="detail-item">
                            <strong>Última actualización:</strong>
                            <span>{{ $project->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="actions">
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Editar</a>
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Volver a Lista</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
