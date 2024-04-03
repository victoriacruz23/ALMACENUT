//validacion formulario 
const formEv = document.getElementById('formsesion');
const inputs = document.querySelectorAll('#formsesion input');

const expresiones = {
  contra: /^(?=.*[A-Z])(?=.*\d).{6,}$/, // Letras, numeros, guion y guion_bajo
}
const campos = {
  contra: false,
  contra2: false,
}

const validarForm = (e) => {
  switch (e.target.name) {
    case "contra":
      validarCampo(expresiones.contra, e.target, 'contra');
      break;
    case "contra2":
      validarCampo(expresiones.contra, e.target, 'contra2');
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
  if (campos.contra && campos.contra2) {
    document.getElementById('btnsesion').classList.remove('disabled');
  } else {
    document.getElementById('btnsesion').classList.add('disabled');
  }
}

function inicioSesion(event) {
  event.preventDefault(); // Evita que el evento por defecto se lleve a cabo

  const password = document.querySelector("#contra").value,
    password2 = document.querySelector("#contra2").value;
  if (password !== password2) {
    alerta("error", "Las contraseñas no coiciden");
    return false;
  }
  // console.log("El dominio es: " + dominio);
  fetch('editar-contrasena-correo', {
    method: 'POST',
    body: new FormData(formsesion)
  }).then(response => response.json()).then(response => {
    document.getElementById('btnsesion').classList.add('disabled');
    // console.log(response);
    if (response.respuesta == true) {
      limpiarform();
      // Desactivar el botón de envío
      let dominio = window.location.hostname + "/ALMACENUT/inicio";

      alertair(response.icon, response.message, 'inicio');
      return false;
    } else {
      alerta(response.icon, response.message);
      return false;
    }

  });
}

function togglePasswordVisibility(passwordId) {
  const passwordInput = document.getElementById(passwordId);
  const buttonIcon = passwordInput.nextElementSibling.querySelector('i');

  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    buttonIcon.classList.remove('bi-eye');
    buttonIcon.classList.add('bi-eye-slash');
  } else {
    passwordInput.type = 'password';
    buttonIcon.classList.remove('bi-eye-slash');
    buttonIcon.classList.add('bi-eye');
  }
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
function limpiarform() {
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