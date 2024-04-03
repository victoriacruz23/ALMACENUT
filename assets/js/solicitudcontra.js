//validacion formulario 
const formEv = document.getElementById('formsesion');
const inputs = document.querySelectorAll('#formsesion input');

const expresiones = {
    correo: /^[a-z]+\.[a-z]+$/, // Letras, numeros, guion y guion_bajo
}
const campos = {
    correo: false,
}

const validarForm = (e) => {
    switch (e.target.name) {
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
    if (campos.correo) {
        document.getElementById('btnsesion').classList.remove('disabled');
    } else {
        document.getElementById('btnsesion').classList.add('disabled');
    }
}

function inicioSesion(event) {
    event.preventDefault(); // Evita que el evento por defecto se lleve a cabo
    document.getElementById('btnsesion').classList.add('disabled');

    fetch('enviar-correo-contra', {
        method: 'POST',
        body: new FormData(formsesion)
    }).then(response => response.json()).then(response => {
        // console.log(response);
        limpiarform();
        if (response.respuesta == true) {
            alerta(response.icon, response.message);
            return false;
        } else if (response.respuesta == false) {
            alerta(response.icon, response.message);
            return false;
        }
        else {
            alerta(response.icon, response.message);

        }
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
