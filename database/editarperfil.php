<?php
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'editar':
            editar();
            break;
    }
}

function editar()
{
    include('conexion.php');
    // Obtener datos del formulario
    $id = $_POST['id']; // ID del medicamento que se está editando
    $nombre = $_POST['fullName'];
    $apellidos = $_POST['lastName'];
    
    // Verificar si se cargó una nueva imagen
    if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
        $foto = $_FILES['foto'];
        $img_type = $foto['type'];

        // Si se trata de una imagen   
        if (((strpos($img_type, "jpeg") ||
            strpos($img_type, "jpg")) || strpos($img_type, "png"))) {

                // Obtener el nombre y la extensión del archivo
                $nombreArchivo = $foto['name'];
                // Mover el archivo cargado al directorio de imágenes
                $rutaDestino = "../images/$nombreArchivo";
                move_uploaded_file($foto['tmp_name'], $rutaDestino);
                // Actualizar la ruta de la imagen en la base de datos
                $sql_update = "UPDATE usuario SET nombre='$nombre', apellidos='$apellidos', foto='$rutaDestino' WHERE id_usuario='$id'";
        } else {
            // Si se cargó un archivo pero no es una imagen válida, mostrar mensaje de error
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script language='JavaScript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se acepta este tipo de archivos',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                  }).then(() => {
                    location.assign('../config.php');
                });
            });
            </script>";
            exit;
        }
    } else {
        // Si no se cargó una nueva imagen, actualizar los campos sin modificar la imagen en la base de datos
        $sql_update = "UPDATE usuario SET nombre='$nombre', apellidos='$apellidos' WHERE id_usuario='$id'";
    }

    // Ejecutar la consulta de actualización
    if ($conn->query($sql_update) === TRUE) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Se actualizó correctamente',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                timer: 1500
              }).then(() => {
                location.assign('../config.php');
              });
        });
        </script>";
    } else {
        echo "Error al actualizar el medicamento: " . $conn->error;
    }

    $conn->close();
}
?>