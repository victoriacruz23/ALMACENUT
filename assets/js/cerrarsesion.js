function cerrarsesion(event) {
    event.preventDefault();
    Swal.fire({
      title: "¿Desea Cerrar sesion?",
      text: "Al cerrar sesion usted no podra tener acceso al contenido",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "Cancelar",
      confirmButtonText: "Cerrar sesion",
    }).then((result) => {
      if (result.isConfirmed) {
        var domain = window.location.protocol + '//' + window.location.hostname,
          ruta = `${domain}/ALMACENUT/cerrar-session`;
        fetch(`${ruta}`).then(response => response.json()).then(response => {
          if (response.success == true) {
            alertfin('success', `${response.message}`);
            return false;
          } else {
            alertfin('error', `${response.message}`);
          }
        });
      }
    })
  }
  
  function alertfin(tipo, titulo) {
    Swal.fire({
      icon: tipo,
      title: titulo,
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = 'inicio'
    })
  }