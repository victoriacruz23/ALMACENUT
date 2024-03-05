// Obtiene el correo de los parámetros de la URL
const urlParams = new URLSearchParams(window.location.search);
const nombre = urlParams.get('nombre');

// Verifica si la variable GET 'correo' existe
if (nombre) {
  // Muestra la alerta con el correo específico cuando la página se carga
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: "success",
      title: `${nombre} Bienvenido al sistema de inventario uta`,
      showConfirmButton: false,
      timer: 1500
    });
  });
}