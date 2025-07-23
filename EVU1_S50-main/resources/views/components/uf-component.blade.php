<div class="uf-widget animate-fade-in-up">
    <div class="uf-container">
        <h4>💰 Valor UF de Hoy</h4>
        <div id="uf-value" class="uf-value">⏳ Cargando...</div>
        <small class="uf-date" id="uf-date">Consultando datos actualizados...</small>
        <div id="uf-error" class="uf-error" style="display: none;"></div>
        <div style="margin-top: 1rem; opacity: 0.8; font-size: 0.85rem;">
            🔄 Actualizado automáticamente cada 5 min
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
                const ufValue = data.raw_value || data.value;
                const formattedValue = typeof ufValue === 'number' 
                    ? `$${ufValue.toLocaleString('es-CL', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`
                    : `$${data.value}`;
                
                document.getElementById('uf-value').innerHTML = `💵 ${formattedValue}`;
                document.getElementById('uf-error').innerHTML = `⚠️ ${data.error}`;
                document.getElementById('uf-error').style.display = 'block';
                document.getElementById('uf-date').innerHTML = `📅 ${formatDate(data.date)} | 🔄 Valor de respaldo`;
            } else {
                // Mostrar valor oficial
                const ufValue = data.raw_value || parseFloat(data.value.toString().replace(/[^\d.-]/g, ''));
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

    // Cargar valor al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        // Pequeño delay para mejorar la experiencia visual
        setTimeout(fetchUFValue, 800);
    });
    
    // Recargar cada 5 minutos (300000 ms)
    setInterval(fetchUFValue, 300000);
    
    // Agregar click para actualización manual
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
</script>
