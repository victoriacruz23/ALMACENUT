//validacion formulario 

$(document).ready(function () {
  listar();
});
function listar() {
  // fetch("asesorc/dt.json", {})
  fetch("lista-categorias", {})
    .then(response => response.json())
    .then(response => {
      // console.log(response);
      $("#cuerpotabla").empty(); // Vaciar el contenido actual antes de agregar los nuevos datos
      let rows = response.map(unacate => [
        unacate.id_area,
        unacate.nombre,
      ]);

      InicializarDataTable(rows); // Llamada a la función para inicializar el DataTable
      // Llamada a la función para inicializar o reconstruir el DataTable
    });
};
function InicializarDataTable(rows) {
  if ($.fn.DataTable.isDataTable("#tablaSolicitud")) {
    $("#tablaSolicitud").DataTable().destroy();
  }
  $("#tablaSolicitud").empty(); // Vaciar el contenido de la tabla antes de reconstruir
  $("#tablaSolicitud").DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
    },
    data: rows,
    columns: [{
      title: "Id Cat"
    },
    {
      title: "Nombre"
    }
    ]
  });
}
const formEv = document.getElementById('formnevcat');
const inputs = document.querySelectorAll('#formnevcat input');
const expresiones = {
  catego: /^[a-z]{4,25}$/, // Letras, numeros, guion y guion_bajo
}
const campos = {
  catego: false,
}

const validarForm = (e) => {
  switch (e.target.name) {
    case "catego":
      validarCampo(expresiones.catego, e.target, 'catego');
      break;
  }
}
inputs.forEach((input) => {
  input.addEventListener('keyup', validarForm);
  input.addEventListener('blur', validarForm);
});
const validarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    // correcto
    document.getElementById(`${campo}`).classList.remove('is-invalid');
    document.getElementById(`${campo}`).classList.add('is-valid');
    //mensaje
    document.getElementById(`mesaje_${campo}`).classList.add('d-none');
    campos[campo] = true;
  } else {
    //    incorrecto
    document.getElementById(`${campo}`).classList.remove('is-valid');
    document.getElementById(`${campo}`).classList.add('is-invalid');
    //mensaje
    document.getElementById(`mesaje_${campo}`).classList.remove('d-none');
    campos[campo] = false;
  }
  if (campos.catego) {
    document.getElementById('btnCat').classList.remove('disabled');
  } else {
    document.getElementById('btnCat').classList.add('disabled');
  }
}
//funciones apra edutar la Categoria
const myModal = new bootstrap.Modal(document.getElementById('NuevaCategoria'));
btnCat.addEventListener("click", (e) => {
  e.preventDefault();
  fetch('registro-categoria', {
    method: 'POST',
    body: new FormData(formnevcat)
  }).then(response => response.json()).then(response => {
    // console.log(response);
    document.getElementById('btnCat').classList.add('disabled');
    var elemento = document.getElementById('catego');
    // Verificar si tiene la clase 'is-invalid' o 'is-valid'
    if (elemento.classList.contains('is-invalid') || elemento.classList.contains('is-valid')) {
      // Remover la clase 'is-invalid' o 'is-valid'
      elemento.classList.remove('is-invalid');
      elemento.classList.remove('is-valid');
    }
    document.getElementById("formnevcat").reset();
    if (response.respuesta == true) {
      alerta(response.icon, response.message);
      myModal.hide();
      listar();
      return false;
    } else if (response.respuesta == false) {
      alerta(response.icon, response.message);
      return false;
    } else {
      alerta(response.icon, response.message);
    }
  });
});
var miModal = document.getElementById('NuevaCategoria');

miModal.addEventListener('hidden.bs.modal', function () {
  limpiarform();
});
function alerta(icono, titulo) {
  Swal.fire({
    icon: icono,
    title: titulo,
    showConfirmButton: false,
    timer: 1500
  });
}
function limpiarform(){
  formEv.reset();
  // Eliminar clases is-valid y is-invalid
  inputs.forEach(input => {
      input.classList.remove('is-valid', 'is-invalid');
  });
  // Ocultar mensajes de error
  document.querySelectorAll('.mensaje-error').forEach(mensaje => {
      mensaje.classList.add('d-none');
  });
  // Restablecer estado de los campos
  Object.keys(campos).forEach(campo => {
      campos[campo] = false;
  });
}