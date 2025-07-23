
// Función que obtiene la UF y la muestra en pantalla
function getUf() {
    fetch('/api/uf')
        .then(response => response.json())
        .then(data => {
            console.log('DATA: ', data);
            const ufDiv = document.getElementById('uf');
            if (data.success) {
                ufDiv.innerHTML = `UF: ${data.uf.valor}`;
            } else {
                ufDiv.innerHTML = 'No se pudo obtener la UF';
            }
        })
        .catch(error => console.error('Error al obtener la UF:', error));
}

document.addEventListener('DOMContentLoaded', getUf);
