<?php
include_once "conexion.php"; // Incluir archivo de conexión a la base de datos

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de la categoría del formulario
    $catego = $_POST["catego"];

    // Consulta para verificar si ya existe la categoría
    $consulta = "SELECT COUNT(*) as total FROM areas WHERE nombre = '$catego'";
    $resultado = mysqli_query($conexion, $consulta);

    // Obtener el resultado de la consulta
    $fila = mysqli_fetch_assoc($resultado);
    $totalCategorias = $fila["total"];

    // Verificar si la categoría ya existe
    if ($totalCategorias == 0) {
        // Insertar la nueva categoría en la base de datos
        $consultaInsertar = "INSERT INTO areas (nombre) VALUES ('$catego')";
        mysqli_query($conexion, $consultaInsertar);
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                title: 'El área se agregó correctamente.',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
              }).then(() => {
                location.assign('/ALMACENUT/categoria-almacenista');
            });
        });
        </script>";
        exit();
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text:'El área ya existe, por favor ingresa otra.',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
              }).then(() => {
                location.assign('/ALMACENUT/categoria-almacenista');
            });
        });
        </script>";
    }
    $conexion->close();
}
?>
