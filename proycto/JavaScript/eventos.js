document.addEventListener("DOMContentLoaded", function () {
    fetch('/api/events')
        .then(response => response.json())
        .then(data => {
            let contenedor = document.getElementById('eventos-lista');
            if (!contenedor) {
                console.error("No se encontró el elemento con id 'eventos-lista'");
                return;
            }
            contenedor.innerHTML = ''; // Limpiar contenido antes de agregar eventos

            data.forEach(evento => {
                let eventoDiv = document.createElement('div');
                eventoDiv.classList.add('evento');

                // Crear el enlace que envolverá la información del evento
                let enlace = document.createElement('a');
                enlace.href = '/events/show/' + evento.id;
                enlace.classList.add('evento-enlace');

                // Contenido del evento dentro del enlace
                enlace.innerHTML =
                    '<h3>' + evento.name + '</h3>' +
                    '<p><strong>Fecha y Hora:</strong> ' + evento.date + ' - ' + evento.hour + '</p>' +
                    '<p><strong>Ubicación:</strong> ' + evento.location + '</p>';

                // Crear el botón "Me gusta" como una imagen
                if(esMember()){
                    let likeButton = document.createElement('img');
                    likeButton.src = '/images/corazon_blanco.png'; // Ruta absoluta corregida
                    likeButton.classList.add('like-btn');
                    likeButton.dataset.id = evento.id;
                    // Ajustar el tamaño de la imagen
                    likeButton.style.width = '50px';
                    likeButton.style.height = '50px';

                    // Verificar si el evento ya tiene un "Me gusta" en el localStorage
                    if (localStorage.getItem('liked_' + evento.id)) {
                        likeButton.src = '/images/corazon_rosa.png'; // Ruta absoluta corregida
                    }
                    // Agregar el botón "Me gusta" al div del evento (fuera del enlace)
                    eventoDiv.appendChild(likeButton);
                }

                // Agregar el enlace al div del evento
                eventoDiv.appendChild(enlace);


                contenedor.appendChild(eventoDiv);

                // Si el usuario es admin, agregar botones Modificar y Eliminar
                if (esAdmin()) {
                    let adminButtons = document.createElement('div');
                    adminButtons.innerHTML =
                        '<button class="edit-btn" data-id="' + evento.id + '">Modificar</button>' +
                        '<button class="delete-btn" data-id="' + evento.id + '">Eliminar</button>';
                    eventoDiv.appendChild(adminButtons);
                }
            });

            // Event listener para los botones "Me gusta"
            document.querySelectorAll('.like-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault(); // Prevenir el comportamiento predeterminado del clic
                    let eventId = this.dataset.id;
                    if (localStorage.getItem('liked_' + eventId)) {
                        // Si ya tiene un "Me gusta", lo eliminamos
                        localStorage.removeItem('liked_' + eventId);
                        this.src = '/images/corazon_blanco.png'; // Ruta absoluta corregida
                    } else {
                        // Si no tiene un "Me gusta", lo agregamos
                        localStorage.setItem('liked_' + eventId, true);
                        this.src = '/images/corazon_rosa.png'; // Ruta absoluta corregida
                    }
                });
            });

            // Event listener para los botones "Modificar"
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    let eventId = this.dataset.id;
                    // console.log('Modificar evento con ID:', eventId);
                    window.location.href = '/events/edit/' + eventId;
                });
            });

            // Event listener para los botones "Eliminar"
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    let eventId = this.dataset.id;
                    if (confirm('¿Seguro que quieres eliminar este evento?')) {
                        window.location.href = `/events/${eventId}/destroy`;
                    }
                });
            });
        })
        .catch(error => console.error('Error al cargar los eventos:', error));
});

function esAdmin() {
    if (window.user && window.user.rol === 'admin') {
        return true;  // Es administrador
    }
    return false;  // No es administrador o no está logueado
}

function esMember() {
    if (window.user && window.user.rol === 'admin' || window.user && window.user.rol === 'member') {
        return true;  // Es administrador
    }
    return false;  // No es administrador o no está logueado
}





