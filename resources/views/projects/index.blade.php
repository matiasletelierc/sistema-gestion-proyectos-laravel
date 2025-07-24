<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Lista de Proyectos</h1>
        
        @include('components.uf-component')
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="actions">
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Nuevo Proyecto</a>
        </div>
        
        <div class="projects-grid">
            @forelse($projects as $project)
                <div class="project-card">
                    <h3>{{ $project->name }}</h3>
                    <div class="project-meta">
                        <span><strong>Responsable:</strong> {{ $project->responsible }}</span>
                        <span><strong>Estado:</strong> {{ App\Models\Project::getStatusOptions()[$project->status] }}</span>
                        <span><strong>Monto:</strong> ${{ number_format($project->amount, 2) }}</span>
                        <span><strong>Inicio:</strong> {{ $project->start_date->format('d/m/Y') }}</span>
                    </div>
                    <div class="project-actions">
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="no-projects">
                    <p>No hay proyectos disponibles.</p>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">Crear primer proyecto</a>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
