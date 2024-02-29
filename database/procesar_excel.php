<?php
include 'conexion.php';
// Procesar el archivo Excel
if(isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
    $file_name = $_FILES['excel_file']['name'];
    $file_tmp = $_FILES['excel_file']['tmp_name'];

    // Leer el archivo Excel
    require_once '../PHPExcel/Classes/PHPExcel.php'; // Importa la librería PHPExcel (debes tenerla instalada)
    $objPHPExcel = PHPExcel_IOFactory::load($file_tmp);
    $worksheet = $objPHPExcel->getActiveSheet();
    
    // Recorre las filas del archivo Excel
    foreach ($worksheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        // Guardar los datos en la base de datos
        $sql = "INSERT INTO producto (imagen, clave, area_id, nombrepro, caracteristicas, marca, modelo, numserie, estado, existenciaIni, observaciones) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $data = [];
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue();
        }
        $stmt->bind_param("sss", $data[0], $data[1], $data[2]);
        $stmt->execute();
    }
    
    echo "Los datos se han guardado correctamente.";
} else {
    echo "Error al subir el archivo.";
}

$conexion->close();
?>
