document.querySelector('.layout__form').addEventListener('submit', function(e) {
    var nombre = document.querySelector('.form__name').value;
    var contrasena = document.querySelector('.form__password').value;

    if (nombre === '' || contrasena === '') {
        alert('Por favor, completa todos los campos');
        e.preventDefault(); // Evitar que se envíe el formulario
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Seleccionamos el botón de "Recuérdame"
    const rememberMeRadio = document.querySelector('.form__select');

    // Creamos una variable para almacenar si está seleccionado o no
    let isRememberMeChecked = false;

    // Añadimos el evento "click" al radio button
    rememberMeRadio.addEventListener('click', function(e) {
        if (isRememberMeChecked) {
            // Si ya está seleccionado, lo deseleccionamos
            rememberMeRadio.checked = false;
            isRememberMeChecked = false;
        } else {
            // Si no está seleccionado, lo seleccionamos
            isRememberMeChecked = true;
        }
    });
});