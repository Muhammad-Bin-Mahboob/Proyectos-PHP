document.addEventListener("DOMContentLoaded", function () {
    // Obtener el ID del evento desde la URL
    const pathSegments = window.location.pathname.split('/');
    const eventoId = pathSegments[pathSegments.length - 1]; // El último segmento de la URL es el ID
    console.log(eventoId);

    if (eventoId) {
        fetch('/api/events')  // Suponemos que la API devuelve los detalles del evento
            .then(response => response.json())
            .then(eventos => {
                const evento = eventos.find(e => e.id == eventoId); // Filtrar el evento correcto
                if (evento) {
                    let contenedor = document.getElementById('evento-detalle');
                    if (!contenedor) {
                        console.error("No se encontró el elemento con id 'evento-detalle'");
                        return;
                    }

                    // Crear el contenido del evento
                    let eventoHTML = '' +
                    '<h2>' + evento.name + '</h2>' +
                    '<p><strong>Fecha y Hora:</strong> ' + evento.date + ' - ' + evento.hour + '</p>' +
                    '<p><strong>Tipo:</strong> ' + evento.type + '</p>' +
                    '<p><strong>Ubicación:</strong> ' + evento.location + '</p>' +
                    '<p><strong>Descripción:</strong> ' + evento.description + '</p>' +
                    '<p><strong>Contador regresivo:</strong> <span id="contador"></span></p>';

                    // Verificar si el evento ya tiene un "Me gusta" en el localStorage
                    if(esMember()){
                        if (localStorage.getItem('liked_' + evento.id)) {
                            eventoHTML += '<img src="/images/corazon_rosa.png" class="like-btn" data-id="' + evento.id + '" style="width: 50px; height: 50px;">';
                        } else {
                            eventoHTML += '<img src="/images/corazon_blanco.png" class="like-btn" data-id="' + evento.id + '" style="width: 50px; height: 50px;">';
                        }
                    }

                    // Mostrar los botones de admin si es necesario
                    if (esAdmin()) {
                        eventoHTML += '<button class="edit-btn" data-id="' + evento.id + '">Modificar</button>' +
                                      '<button class="delete-btn" data-id="' + evento.id + '">Eliminar</button>';
                    }


                    contenedor.innerHTML = eventoHTML;

                    // Contador regresivo
                    setInterval(function () {
                        let eventoFecha = new Date(evento.date + 'T' + evento.hour);
                        let ahora = new Date();
                        let diferencia = eventoFecha - ahora;

                        if (diferencia <= 0) {
                            document.getElementById('contador').innerText = "¡El evento ha comenzado!";
                        } else {
                            let horas = Math.floor(diferencia / (1000 * 60 * 60));
                            let minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
                            let segundos = Math.floor((diferencia % (1000 * 60)) / 1000);
                            document.getElementById('contador').innerText = `${horas}h ${minutos}m ${segundos}s`;
                        }
                    }, 1000);

                    // Event listener para los botones "Me gusta"
                    document.querySelectorAll('.like-btn').forEach(btn => {
                        btn.addEventListener('click', function (e) {
                            e.preventDefault(); // Prevenir el comportamiento predeterminado del clic
                            let eventId = this.dataset.id;

                            if (localStorage.getItem('liked_' + eventId)) {
                                // Si ya tiene un "Me gusta", lo eliminamos
                                localStorage.removeItem('liked_' + eventId);
                                this.src = '/images/corazon_blanco.png'; // Cambiar a corazón blanco
                            } else {
                                // Si no tiene un "Me gusta", lo agregamos
                                localStorage.setItem('liked_' + eventId, true);
                                this.src = '/images/corazon_rosa.png'; // Cambiar a corazón rosa
                            }
                        });
                    });

                    // Funcionalidad botones Admin (Modificar, Eliminar)
                    document.querySelectorAll('.edit-btn').forEach(btn => {
                        btn.addEventListener('click', function () {
                            let eventId = this.dataset.id;
                            console.log('Modificar evento con ID:', eventId);
                            window.location.href = '/events/edit/' + eventId;
                        });
                    });

                    document.querySelectorAll('.delete-btn').forEach(btn => {
                        btn.addEventListener('click', function () {
                            let eventId = this.dataset.id;
                            if (confirm('¿Seguro que quieres eliminar este evento?')) {
                                window.location.href = `/events/${eventId}/destroy`;
                            }
                        });
                    });
                } else {
                    console.error('Evento no encontrado');
                }
            })
            .catch(error => console.error('Error al cargar el evento:', error));
    }
});

function esAdmin() {
    if (window.user && window.user.rol === 'admin') {
        return true;  // Es administrador
    }
    return false;  // No es administrador o no está logueado
}

function esMember() {
    if (window.user && window.user.rol === 'admin' || window.user && window.user.rol === 'member') {
        return true;  // Es administrador o member
    }
    return false;  // No está logueado
}



