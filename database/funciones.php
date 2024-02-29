<?php 
include 'conexion.php'; // Incluye tu archivo de conexión

function obtenerExistenciaInicial($id_producto, $conexion) {
    $sql = "SELECT existenciaIni FROM producto WHERE id_producto = $id_producto";
    $query = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($query);
    return $fila['existenciaIni'];
}

function obtenerStock($id_producto, $conexion) {
    // Obtener la existencia inicial del producto
    $existencia_inicial = obtenerExistenciaInicial($id_producto, $conexion);
    
    // Obtener las entradas del producto
    $sql_entradas = "SELECT entrada FROM producto WHERE id_producto = $id_producto";
    $query_entradas = mysqli_query($conexion, $sql_entradas);
    $row_entradas = mysqli_fetch_array($query_entradas);
    $total_entradas = $row_entradas['entrada'];
    
    // Obtener las salidas del producto
    $sql_salidas = "SELECT salida FROM producto WHERE id_producto = $id_producto";
    $query_salidas = mysqli_query($conexion, $sql_salidas);
    $row_salidas = mysqli_fetch_array($query_salidas);
    $total_salidas = $row_salidas['salida'];
    
    // Calcular el stock
    $stock = $existencia_inicial + $total_entradas - $total_salidas;
    
    return $stock;
}

function obtenerEntradas($id_producto, $conexion) {
    // Consultar el valor del campo entrada en la tabla producto
    $sql_entradas = "SELECT entrada FROM producto WHERE id_producto = $id_producto";
    $query_entradas = mysqli_query($conexion, $sql_entradas);
    $row_entradas = mysqli_fetch_array($query_entradas);
    $total_entradas = $row_entradas['entrada'];
    
    return $total_entradas;
}

function obtenerSalidas($id_producto, $conexion) {
    // Consultar el valor del campo salida en la tabla producto
    $sql_salidas = "SELECT salida FROM producto WHERE id_producto = $id_producto";
    $query_salidas = mysqli_query($conexion, $sql_salidas);
    $row_salidas = mysqli_fetch_array($query_salidas);
    $total_salidas = $row_salidas['salida'];
    
    return $total_salidas;
} 
?>
