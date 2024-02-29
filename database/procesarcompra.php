<?php
include 'conexion.php'; // Archivo de conexión a la base de datos

// Obtener datos del formulario
$usuario_id = $_POST['usuario_id'];
$fecha_compra = $_POST['fecha_compra'];
$total = $_POST['total'];

// Consulta para insertar la compra en la base de datos
$insertarcompra = "INSERT INTO Compra (usuario_id, fecha_compra, total) VALUES ('$usuario_id', '$fecha_compra', '$total')";

if ($conexion->query($insertarcompra) === TRUE) {
    echo "La compra se ha realizado correctamente.";
} else {
    echo "Error al realizar la compra: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
