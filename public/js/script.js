document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form"); // Selecciona el formulario
    const nombresInput = document.getElementById("nombres"); // Campo de nombres
    const apellidosInput = document.getElementById("apellidos"); // Campo de apellidos
    const carnetInput = document.getElementById("carnet"); // Campo de carnet
    const carreraIdInput = document.getElementById("carrera_id"); // Campo de código de carrera

    form.addEventListener("submit", function(event) {
        // Realiza aquí la validación de los campos
        const nombresPattern = /^[a-zA-Z\s]+$/; // Patrón para nombres y apellidos (solo letras y espacios)
        const carnetPattern = /^\d+$/; // Patrón para carnet y código de carrera (solo números)

        if (!nombresPattern.test(nombresInput.value.trim())) {
            event.preventDefault();
            alert("El campo de nombres solo permite letras y espacios.");
        }
        
        if (!nombresPattern.test(apellidosInput.value.trim())) {
            event.preventDefault();
            alert("El campo de apellidos solo permite letras y espacios.");
        }

        if (!carnetPattern.test(carnetInput.value.trim())) {
            event.preventDefault();
            alert("El campo de carnet solo permite números.");
        }

        if (!carnetPattern.test(carreraIdInput.value.trim())) {
            event.preventDefault();
            alert("El campo de código de carrera solo permite números.");
        }
    });
});
