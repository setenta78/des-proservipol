<?php

require_once "config.php";

// Consulta SQL para seleccionar los datos de la tabla MARCA_VIDEOCAMARA
$sqlMarca = "SELECT MVC_CODIGO, MVC_DESCRIPCION FROM MARCA_VIDEOCAMARA";
$resultMarca = $link->query($sqlMarca);

// Verificar si la consulta fue exitosa
if ($resultMarca && $resultMarca->num_rows > 0) {
    // Recorrer los resultados
    while ($rowMarca = $resultMarca->fetch_assoc()) {
        $mvcCodigo[] = $rowMarca['MVC_CODIGO'];
        $mvcDescripcion[] = $rowMarca['MVC_DESCRIPCION'];
        /* echo "<pre>";
        print_r($rowMarca);
        echo "</pre>";*/
    }
    $ultimoCodigo = end($mvcCodigo);
    // echo "El último código es: " . $ultimoCodigo;
} else {
    echo "No se encontraron resultados de cámaras.";
}






// Consulta SQL para seleccionar los datos de la tabla MODELO_VIDEOCAMARA
$sqlModelo = "SELECT MODVC_CODIGO, MODVC_DESCRIPCION FROM MODELO_VIDEOCAMARA";
$resultModelo = $link->query($sqlModelo);

// Verificar si se obtuvieron resultados
if ($resultModelo && $resultModelo->num_rows > 0) {
    // Recorrer los resultados y agregar los valores a los arrays
    while ($rowModelo = $resultModelo->fetch_assoc()) {
        $modvcCodigo[] = $rowModelo['MODVC_CODIGO'];
        $modvcDescripcion[] = $rowModelo['MODVC_DESCRIPCION'];
        /* echo "<pre>";
        print_r($rowModelo);
        echo "</pre>";*/
    }
    $ultimoCodigo = end($modvcCodigo);
    echo "El último código es: " . $ultimoCodigo;
} else {
    echo "No se encontraron resultados de modleos.";
}
