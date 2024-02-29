<?php
require_once 'conexion.php';

// Obtener datos del formulario
$img = $_FILES['img'];
$clave = $_POST['clave'];
$producto = $_POST['producto'];
$caracter = $_POST['caracter'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$numserie = $_POST['numserie'];
// $estado = $_POST['estado'];
$catego = $_POST['catego'];
$cantidad = $_POST['cantidad'];
$observa = $_POST['observa'];


// Verificar si el nombre de producto ya existe
$sql_product = "SELECT * FROM producto WHERE nombrepro='$producto'";
$result_product = $conexion->query($sql_product);

if ($result_product->num_rows > 0) {
    // Mostrar mensaje de error si el producto ya existe
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script language='JavaScript'>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error al registrar',
            text: 'El producto ya está registrado, por favor ingresa otro!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK',
          }).then(() => {
            location.assign('../almacenista/productos.php');
        });
    });
</script>";
    exit;
}

// Insertar datos en la base de datos
$tmp_name = $img['tmp_name'];
$directorio_destino = "../imgpro";

$img_file = $img['name'];
$img_type = $img['type'];

// Verificar si se trata de una imagen
if (((strpos($img_type, "jpeg") || strpos($img_type, "jpg")) || strpos($img_type, "png"))) {
    // Definir el destino de la imagen
    $destino = $directorio_destino . '/' .  $img_file;

    // Insertar datos en la tabla
    $sql = "INSERT INTO producto(imagen, clave, area_id, nombrepro, caracteristicas, marca, modelo, numserie, existenciaIni, observaciones) 
    VALUES ('$destino','$clave','$catego','$producto','$caracter','$marca','$modelo','$numserie','$cantidad','$observa')";

    if (mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito si la inserción fue exitosa
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script language='JavaScript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'El registro fue guardado correctamente',
                    showCancelButton: false,
                    confirmButtonColor: '#4c5dac',
                    confirmButtonText: 'OK',
                }).then(() => {
                    location.assign('../almacenista/productos.php');
                });
            });
            </script>";
    } else {
        // Mostrar mensaje de error si ocurrió un error al insertar los datos
        echo "Error al registrar el producto: " . mysqli_error($conexion);
    }

    // Mover el archivo de imagen al destino
    if (move_uploaded_file($tmp_name, $destino)) {
        return true;
    }
    // Si llegamos aquí, algo ha fallado
    return false;
} else {
    // Mostrar mensaje de error si el tipo de archivo no es aceptado
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script language='JavaScript'>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se acepta este tipo de archivos',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK',
          }).then(() => {
            location.assign('../almacenista/productos.php');
        });
    });
</script>";
}

$conexion->close();
?>
