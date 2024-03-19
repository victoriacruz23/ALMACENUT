//validacion formulario 
const formEv = document.getElementById('formsesion');
const inputs = document.querySelectorAll('#formsesion input');
const expresiones = {
  contra: /^(?=.*[A-Z])(?=.*\d).{6,}$/, // Letras, numeros, guion y guion_bajo
  correo: /^[a-z]+\.[a-z]+$/, // Letras, numeros, guion y guion_bajo
}
const campos = {
  contra: false,
  correo: false,
}

const validarForm = (e) => {
  switch (e.target.name) {
    case "contra":
      validarCampo(expresiones.contra, e.target, 'contra');
      break;
    case "correo":
      validarCampo(expresiones.correo, e.target, 'correo');
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
  if (campos.contra && campos.correo) {
    document.getElementById('btnsesion').classList.remove('disabled');
  } else {
    document.getElementById('btnsesion').classList.add('disabled');
  }
}

function inicioSesion(event) {
  event.preventDefault(); // Evita que el evento por defecto se lleve a cabo

  fetch('inicio-sesion', {
    method: 'POST',
    body: new FormData(formsesion)
  }).then(response => response.json()).then(response => {
    console.log(response);
    if (response.respuesta == 'almacen') {
      alertair(response.icon, response.message, "inicio-almacenista");
      return false;
    }
    else if (response.respuesta == 'alumno') {
      alertair(response.icon, response.message, "inicio-alumnos");
      return false;
    }
    else if (response.respuesta == false) {
      alerta(response.icon, response.message);
      return false;
    }
    else {
      alerta(response.icon, response.message);

    }
  });
}


function alerta(icono, titulo) {
  Swal.fire({
    icon: icono,
    title: titulo,
    showConfirmButton: false,
    timer: 1500
  });
}
function alertair(icono, titulo, ir) {
  Swal.fire({
    icon: icono,
    title: titulo,
    showConfirmButton: false,
    timer: 1500
  }).then(function () {
    window.location = ir;
  });
}
