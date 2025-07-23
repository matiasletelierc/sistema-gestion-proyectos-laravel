<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚀 Gestión de Proyectos - Lista</title>
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

        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="alert alert-success animate-fade-in-up">
                <strong>✅ ¡Éxito!</strong> {{ session('success') }}
            </div>
        @endif

        <div class="card animate-fade-in-up">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
                <h2>📋 Lista de Proyectos</h2>
                <a href="{{ route('projects.create') }}" class="btn btn-primary">
                    ➕ Nuevo Proyecto
                </a>
            </div>

            @if($projects->count() > 0)
                <!-- Vista Grid -->
                <div class="projects-grid grid grid-2">
                    @foreach($projects as $project)
                        <div class="project-card card" style="padding: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                                <h3 style="margin: 0; color: white; font-size: 1.25rem;">{{ $project->name }}</h3>
                                <span class="status-indicator">
                                    <span class="status-dot {{ 
                                        $project->status === 'in_progress' ? 'online' : 
                                        ($project->status === 'completed' ? 'offline' : 'loading') 
                                    }}"></span>
                                    {{ $project->status }}
                                </span>
                            </div>
                            
                            <div class="project-meta" style="margin-bottom: 1.5rem; line-height: 1.8;">
                                <div style="color: rgba(255,255,255,0.9);">
                                    <strong>👤 Responsable:</strong> {{ $project->responsible }}
                                </div>
                                <div style="color: rgba(255,255,255,0.9);">
                                    <strong>💰 Monto:</strong> ${{ number_format($project->amount, 0, ',', '.') }}
                                </div>
                                <div style="color: rgba(255,255,255,0.9);">
                                    <strong>📅 Inicio:</strong> {{ $project->start_date->format('d/m/Y') }}
                                </div>
                            </div>
                            
                            <div class="project-actions" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem; flex: 1; text-align: center;">
                                    👁️ Ver
                                </a>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning" style="padding: 0.5rem 1rem; font-size: 0.85rem; flex: 1; text-align: center;">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger micro-interaction" 
                                            style="padding: 0.5rem 1rem; font-size: 0.85rem; width: 100%;" 
                                            onclick="return confirmDelete('{{ $project->name }}')">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <h3>📝 No hay proyectos registrados</h3>
                    <p>¡Comienza creando tu primer proyecto para gestionar tu trabajo de manera eficiente!</p>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                        ➕ Crear Primer Proyecto
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Animaciones al cargar
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.project-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate-fade-in-up');
            });
        });

        // Confirmación de eliminación con notificación
        function confirmDelete(projectName) {
            return new Promise((resolve) => {
                showWarning(
                    `¿Estás seguro de que deseas eliminar el proyecto "${projectName}"? Esta acción no se puede deshacer.`,
                    {
                        title: '⚠️ Confirmar Eliminación',
                        duration: 0,
                        closable: true
                    }
                );

                // Crear botones de confirmación dinámicamente
                setTimeout(() => {
                    const notification = document.querySelector('.notification.warning:last-child');
                    if (notification) {
                        const messageDiv = notification.querySelector('.notification-message');
                        messageDiv.innerHTML += `
                            <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: flex-end;">
                                <button onclick="cancelDelete()" class="btn btn-secondary" style="padding: 8px 16px; font-size: 13px;">
                                    Cancelar
                                </button>
                                <button onclick="proceedDelete()" class="btn btn-danger" style="padding: 8px 16px; font-size: 13px;">
                                    Eliminar
                                </button>
                            </div>
                        `;
                    }
                }, 100);

                window.pendingDeleteResolve = resolve;
            });
        }

        function proceedDelete() {
            notificationSystem.clear();
            window.pendingDeleteResolve(true);
        }

        function cancelDelete() {
            notificationSystem.clear();
            window.pendingDeleteResolve(false);
        }
    </script>
</body>
</html>
