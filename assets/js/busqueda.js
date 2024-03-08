// Obtén el formulario de búsqueda
var searchForm = document.querySelector('.search-form');

// Agrega un evento de escucha para el envío del formulario
searchForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Evita el comportamiento de envío por defecto

  // Realiza la búsqueda
  buscar();
});
function buscar() {
    // Obtener el término de búsqueda
    var termino = document.getElementById("termino").value;
  
    // Buscar el término en el documento
    if (window.find && window.getSelection) {
      // Si el navegador admite la API de búsqueda
      if (window.find(termino)) {
        // Eliminar los elementos resaltados previamente
        var resaltados = document.querySelectorAll(".resaltado");
        for (var i = 0; i < resaltados.length; i++) {
          resaltados[i].outerHTML = resaltados[i].innerHTML;
        }
        // Resaltar la coincidencia
        var range = window.getSelection().getRangeAt(0);
        var newNode = document.createElement("span");
        newNode.setAttribute("class", "resaltado");
        range.surroundContents(newNode);
      } else {
        mensaje('error', `No se encontró ${termino}`)
        // Eliminar los elementos resaltados previamente
        eliminarResltado();
      }
    } else {
      // Si el navegador no admite la API de búsqueda
      var contenido = document.body.innerHTML;
      var coincidencias = contenido.match(new RegExp(termino, "gi"));
      if (coincidencias) {
        // Eliminar los elementos resaltados previamente
        var resaltados = document.querySelectorAll(".resaltado");
        for (var i = 0; i < resaltados.length; i++) {
          resaltados[i].outerHTML = resaltados[i].innerHTML;
        }
        // Resaltar las coincidencias
        for (var i = 0; i < coincidencias.length; i++) {
          contenido = contenido.replace(new RegExp("(" + coincidencias[i] + ")", "gi"), "<span class='resaltado'>$1</span>");
        }
        document.body.innerHTML = contenido;
      } else {
        // Eliminar los elementos resaltados previamente
        eliminarResltado();
        mensaje('error', 'No se encontro otro resultado.')
      }
    }
  }
  
  function eliminarResltado() {
    var resaltados = document.querySelectorAll(".resaltado");
    for (var i = 0; i < resaltados.length; i++) {
      resaltados[i].outerHTML = resaltados[i].innerHTML;
    }
  }
  
  function mensaje(icon, text) {
    Swal.fire({
      icon: `${icon}`,
      title: `${text}`,
      showConfirmButton: false,
      timer: 1500
    })
  }
