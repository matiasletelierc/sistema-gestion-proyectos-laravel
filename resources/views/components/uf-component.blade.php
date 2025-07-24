<div class="uf-widget">
    <div class="uf-container">
        <h4>💰 Valor UF Hoy</h4>
        <div id="uf-value" class="uf-value">Cargando...</div>
        <small class="uf-date" id="uf-date"></small>
        <div id="uf-error" class="uf-error" style="display: none;"></div>
    </div>
</div>

<script>
    async function fetchUFValue() {
        try {
            const response = await fetch('/api/uf-value');
            const data = await response.json();
            
            if (data.error) {
                document.getElementById('uf-value').textContent = data.value;
                document.getElementById('uf-error').textContent = 'Error: ' + data.error;
                document.getElementById('uf-error').style.display = 'block';
            } else {
                document.getElementById('uf-value').textContent = `$${data.value}`;
                document.getElementById('uf-date').textContent = `Fecha: ${data.date}`;
            }
        } catch (error) {
            document.getElementById('uf-value').textContent = 'Error al cargar UF';
            document.getElementById('uf-error').textContent = 'No se pudo conectar con el servicio';
            document.getElementById('uf-error').style.display = 'block';
            console.error('Error fetching UF value:', error);
        }
    }

    // Cargar valor al cargar la página
    document.addEventListener('DOMContentLoaded', fetchUFValue);
    
    // Recargar cada 5 minutos
    setInterval(fetchUFValue, 300000);
</script>
