    //validacion formulario 
    const formEv = document.getElementById('formregistro');
    const inputs = document.querySelectorAll('#formregistro input');
    const expresiones = {
        password: /^(?=.*[A-Z])(?=.*\d).{6,}$/, // Letras, numeros, guion y guion_bajo
    }
    const campos = {
        pass: false,
        pass2: false,
    }
    
    const validarForm = (e) => {
        switch (e.target.name) {
            case "pass":
                validarCampo(expresiones.password, e.target, 'pass');
                break;
            case "pass2":
                validarCampo(expresiones.password, e.target, 'pass2');
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
        if(campos.pass && campos.pass2){
          document.getElementById('btnregistro').classList.remove('disabled');
        } else{
          document.getElementById('btnregistro').classList.add('disabled');
        }
    }
    
    function registroDatos(event) {
      event.preventDefault(); // Evita que el evento por defecto se lleve a cabo
      var select = document.getElementById("rol").value;
      const password = document.querySelector("#pass").value,
      password2 = document.querySelector("#pass2").value;
      if (select === "0") {
        alerta('warning',"Debe seleccionar un perfil");
        return false;
      }
      if (password !== password2) {
        alerta("error", "Las contraseñas no coiciden");
        return false;
      }
      if (!document.getElementById("terminos").checked) {
        alerta("warning", "Usted debe aceptar los terminos y condiciones");
        return false;
      }

      fetch('database/registro.php',{
        method:'POST',
        body: new FormData(formregistro)
      }).then(response => response.text()).then(response=>{
        console.log(response);
      });
  }


  function alerta(icono,titulo){
    Swal.fire({
      icon: icono,
      title: titulo,
      showConfirmButton: false,
      timer: 1500
    });
  }