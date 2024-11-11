// Función para actualizar el estado de los pings
function updatePingStatus() {
    fetch('/pings/validate')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            data.forEach(ping => {
                const pingRow = document.querySelector(`.ping-status[data-ip="${ping.ip_dominio}"]`);
                if (pingRow) {
                    pingRow.textContent = ping.estado;
                }
            });
        })
        .catch(error => console.error('Error al actualizar el estado de los pings:', error));
}

// Ejecutar la actualización cada 5 segundos
setInterval(updatePingStatus, 5000);
