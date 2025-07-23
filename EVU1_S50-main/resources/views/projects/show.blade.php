<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>👁️ {{ $project->name }} - Detalle del Proyecto</title>
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

        <div class="card animate-fade-in-up">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
                <h2>👁️ Detalle del Proyecto</h2>
                <span class="status-badge status-{{ str_replace(' ', '-', strtolower($project->status)) }}">
                    {{ $project->status }}
                </span>
            </div>

            <div class="grid grid-2" style="margin-bottom: 2rem;">
                <div class="project-detail-card card" style="padding: 1.5rem;">
                    <h3 style="color: white; margin-bottom: 1rem;">📋 Información General</h3>
                    <div style="line-height: 2;">
                        <div style="color: rgba(255,255,255,0.9);">
                            <strong>🏷️ Nombre:</strong> {{ $project->name }}
                        </div>
                        <div style="color: rgba(255,255,255,0.9);">
                            <strong>👤 Responsable:</strong> {{ $project->responsible }}
                        </div>
                        <div style="color: rgba(255,255,255,0.9);">
                            <strong>📅 Fecha de Inicio:</strong> {{ $project->start_date->format('d/m/Y') }}
                        </div>
                    </div>
                </div>

                <div class="project-detail-card card" style="padding: 1.5rem;">
                    <h3 style="color: white; margin-bottom: 1rem;">💰 Información Financiera</h3>
                    <div style="line-height: 2;">
                        <div style="color: rgba(255,255,255,0.9);">
                            <strong>💵 Monto:</strong> ${{ number_format($project->amount, 0, ',', '.') }}
                        </div>
                        <div style="color: rgba(255,255,255,0.9);">
                            <strong>📊 Estado:</strong> {{ $project->status }}
                        </div>
                        <div style="color: rgba(255,255,255,0.9);">
                            <strong>📈 Presupuesto:</strong> 
                            <span style="color: #10b981;">{{ $project->amount >= 100000 ? 'Alto' : ($project->amount >= 50000 ? 'Medio' : 'Bajo') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">
                    ✏️ Editar Proyecto
                </a>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                    📋 Volver a Lista
                </a>
                <form method="POST" action="{{ route('projects.destroy', $project) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('🗑️ ¿Estás seguro de eliminar este proyecto? Esta acción no se puede deshacer.')">
                        🗑️ Eliminar Proyecto
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Animación de entrada de las cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.project-detail-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.2}s`;
                card.classList.add('animate-fade-in-up');
            });
        });
    </script>
</body>
</html>
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
