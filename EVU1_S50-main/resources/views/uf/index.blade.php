<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💰 Valor UF - Unidad de Fomento</title>
    <link rel="stylesheet" href="{{ asset('assets/css/modern-app.css') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💰</text></svg>">
</head>
<body>
    <div class="container">
        <header class="animate-fade-in-up">
            <h1>💰 Valor UF - Unidad de Fomento</h1>
        </header>

        <nav class="animate-fade-in-up">
            <ul>
                <li><a href="{{ route('projects.index') }}">📋 Lista de Proyectos</a></li>
                <li><a href="{{ route('projects.create') }}">➕ Crear Proyecto</a></li>
                <li><a href="/uf">💰 Valor UF</a></li>
            </ul>
        </nav>

        <!-- Componente UF Principal -->
        <div class="card animate-fade-in-up" style="text-align: center;">
            <h2>💰 Valor Actual de la UF</h2>
            <p style="color: rgba(255,255,255,0.8); margin-bottom: 2rem;">
                La Unidad de Fomento (UF) es una unidad de cuenta reajustable de acuerdo con la inflación, utilizada en Chile.
            </p>
            
            <!-- Widget UF Mejorado -->
            <div class="uf-widget" style="margin: 2rem auto; max-width: 500px;">
                <div class="uf-container">
                    <h4>💰 Valor UF de Hoy</h4>
                    <div id="uf-value" class="uf-value">⏳ Cargando...</div>
                    <small class="uf-date" id="uf-date">Consultando datos actualizados...</small>
                    <div id="uf-error" class="uf-error" style="display: none;"></div>
                    <div style="margin-top: 1rem; opacity: 0.8; font-size: 0.85rem;">
                        🔄 Actualizado automáticamente cada 5 min | 📱 Haz click para actualizar
                    </div>
                </div>
            </div>
        </div>

        <!-- Información adicional sobre la UF -->
        <div class="grid grid-2">
            <div class="card animate-fade-in-up">
                <h3>📊 ¿Qué es la UF?</h3>
                <div style="color: rgba(255,255,255,0.9); line-height: 1.8;">
                    <p><strong>🔹 Definición:</strong> La Unidad de Fomento es una unidad de cuenta reajustable según la inflación.</p>
                    <p><strong>🔹 Uso:</strong> Se utiliza para expresar el valor de contratos, créditos hipotecarios y otros instrumentos financieros.</p>
                    <p><strong>🔹 Actualización:</strong> Se calcula diariamente por el Banco Central de Chile.</p>
                </div>
            </div>

            <div class="card animate-fade-in-up">
                <h3>📈 Datos del Servicio</h3>
                <div style="color: rgba(255,255,255,0.9); line-height: 1.8;">
                    <p><strong>🔹 Fuente:</strong> Mindicador.cl - API Oficial</p>
                    <p><strong>🔹 Frecuencia:</strong> Datos actualizados diariamente</p>
                    <p><strong>🔹 Cache:</strong> Los datos se almacenan por 1 hora para mejor rendimiento</p>
                    <p><strong>🔹 Respaldo:</strong> Sistema de valores de respaldo en caso de falla</p>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="card animate-fade-in-up" style="text-align: center;">
            <h3>⚡ Acciones Rápidas</h3>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 1.5rem;">
                <button onclick="fetchUFValue()" class="btn btn-primary">
                    🔄 Actualizar UF
                </button>
                <button onclick="copyUFValue()" class="btn btn-secondary">
                    📋 Copiar Valor
                </button>
                <a href="{{ route('projects.index') }}" class="btn btn-warning">
                    📋 Volver a Proyectos
                </a>
            </div>
        </div>
    </div>

    <script>
        async function fetchUFValue() {
            try {
                // Mostrar estado de carga
                document.getElementById('uf-value').innerHTML = '⏳ Actualizando...';
                document.getElementById('uf-date').innerHTML = 'Conectando con mindicador.cl...';
                
                const response = await fetch('/api/uf-value');
                const data = await response.json();
                
                console.log('Datos UF recibidos:', data); // Para debug
                
                if (data.error) {
                    // Mostrar valor de respaldo
                    const ufValue = data.value;
                    const formattedValue = typeof ufValue === 'number' 
                        ? `$${ufValue.toLocaleString('es-CL', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`
                        : `$${data.value}`;
                    
                    document.getElementById('uf-value').innerHTML = `💵 ${formattedValue}`;
                    document.getElementById('uf-error').innerHTML = `⚠️ ${data.error}`;
                    document.getElementById('uf-error').style.display = 'block';
                    document.getElementById('uf-date').innerHTML = `📅 ${formatDate(data.date)} | 🔄 Valor de respaldo`;
                } else {
                    // Mostrar valor oficial
                    const ufValue = data.value;
                    const formattedValue = `$${ufValue.toLocaleString('es-CL', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                    
                    document.getElementById('uf-value').innerHTML = `💵 ${formattedValue}`;
                    document.getElementById('uf-date').innerHTML = `📅 ${formatDate(data.date)} | ✅ Datos oficiales mindicador.cl`;
                    document.getElementById('uf-error').style.display = 'none';
                }
            } catch (error) {
                console.error('Error fetching UF value:', error);
                document.getElementById('uf-value').innerHTML = '❌ Error de conexión';
                document.getElementById('uf-error').innerHTML = '🔌 No se pudo conectar con el servicio. Verifica tu conexión a internet.';
                document.getElementById('uf-error').style.display = 'block';
                document.getElementById('uf-date').innerHTML = 'Sin conexión';
            }
        }

        function formatDate(dateString) {
            try {
                const date = new Date(dateString);
                return date.toLocaleDateString('es-CL', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            } catch (e) {
                return dateString;
            }
        }

        function copyUFValue() {
            const ufValueElement = document.getElementById('uf-value');
            const textToCopy = ufValueElement.textContent.replace('💵 ', '');
            
            if (navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy).then(function() {
                    // Mostrar feedback visual
                    const originalText = ufValueElement.innerHTML;
                    ufValueElement.innerHTML = '📋 ¡Copiado!';
                    ufValueElement.style.backgroundColor = 'rgba(16, 185, 129, 0.3)';
                    
                    setTimeout(() => {
                        ufValueElement.innerHTML = originalText;
                        ufValueElement.style.backgroundColor = '';
                    }, 1500);
                });
            } else {
                // Fallback para navegadores antiguos
                const textArea = document.createElement('textarea');
                textArea.value = textToCopy;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                
                alert('Valor UF copiado: ' + textToCopy);
            }
        }

        // Cargar valor al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Pequeño delay para mejorar la experiencia visual
            setTimeout(fetchUFValue, 800);
        });
        
        // Recargar cada 5 minutos (300000 ms)
        setInterval(fetchUFValue, 300000);
        
        // Agregar click para actualización manual al widget
        document.querySelector('.uf-widget').addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 100);
            fetchUFValue();
        });
        
        // Tooltip en hover
        document.querySelector('.uf-widget').addEventListener('mouseenter', function() {
            this.style.cursor = 'pointer';
            this.title = 'Haz click para actualizar manualmente';
        });

        // Animaciones al cargar
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.2}s`;
                card.classList.add('animate-fade-in-up');
            });
        });
    </script>
</body>
</html>
