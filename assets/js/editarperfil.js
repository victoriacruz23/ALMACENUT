//validacion formulario 
const formEv = document.getElementById('editarcontra');
const inputs = document.querySelectorAll('#editarcontra input');
const expresiones = {
    password: /^(?=.*[A-Z])(?=.*\d).{6,}$/, // Letras, numeros, guion y guion_bajo
}
const campos = {
    currentPassword: false,
    newpassword: false,
    renewpassword: false,
}

const validarForm = (e) => {
    switch (e.target.name) {
        case "currentPassword":
            validarCampo(expresiones.password, e.target, 'currentPassword');
            break;
        case "newpassword":
            validarCampo(expresiones.password, e.target, 'newpassword');
            break;
        case "renewpassword":
            validarCampo(expresiones.password, e.target, 'renewpassword');
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
    if (campos.currentPassword && campos.newpassword && campos.renewpassword) {
        document.getElementById('btnupdatecontra').classList.remove('disabled');
    } else {
        document.getElementById('btnupdatecontra').classList.add('disabled');
    }
}

function updatePassword(event) {
    event.preventDefault(); // Evita que el evento por defecto se lleve a cabo
    const password = document.querySelector("#newpassword").value,
        password2 = document.querySelector("#renewpassword").value;
    if (password !== password2) {
        alerta("error", "Las contraseñas no coiciden");
        return false;
    }
    fetch('editar-contrasena', {
        method: 'POST',
        body: new FormData(editarcontra)
    }).then(response => response.json()).then(response => {
        document.getElementById('btnupdatecontra').classList.add('disabled');
        // console.log(response);
        if (response.respuesta == true) {
            alerta(response.icon, response.message);
          limpiarform();
            // Desactivar el botón de envío
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