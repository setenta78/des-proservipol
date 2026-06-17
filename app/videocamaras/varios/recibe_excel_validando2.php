<?php
require('config.php');
//DATA DE ARCHIVO
$archivotmp = $_FILES['dataCamara']['tmp_name'];
$tipo       = $_FILES['dataCamara']['type'];
$tamanio    = $_FILES['dataCamara']['size'];
$lineas     = file($archivotmp);

if (empty($archivotmp) || $tipo !== 'text/csv') {
    die("No se ha subido ningún archivo válido");
}

//Declaro variables
$i = 0;
$updateData = [];
$insertData = [];
$mvcCodigo = [];
$mvcDescripcion = [];
$modvcCodigo = [];
$modvcDescripcion = [];

// Consulta SQL para seleccionar los datos de la tabla MARCA_VIDEOCAMARA
$sqlMarca = "SELECT MVC_CODIGO, MVC_DESCRIPCION FROM MARCA_VIDEOCAMARA";
$resultMarca = $con->query($sqlMarca);

// Verificar si se obtuvieron resultados
if ($resultMarca->num_rows > 0) {
    // Recorrer los resultados y agregar los valores a los arrays
    while ($rowMarca = $resultMarca->fetch_assoc()) {
        $mvcCodigo[] = $rowMarca['MVC_CODIGO'];          // Guardar en el array mvcCodigo
        $mvcDescripcion[] = $rowMarca['MVC_DESCRIPCION']; // Guardar en el array mvcDescripcion
    }
}

// Consulta SQL para seleccionar los datos de la tabla MODELO_VIDEOCAMARA
$sqlModelo = "SELECT MODVC_CODIGO, MODVC_DESCRIPCION FROM MODELO_VIDEOCAMARA";
$resultModelo = $con->query($sqlModelo);

// Verificar si se obtuvieron resultados
if ($resultModelo->num_rows > 0) {
    // Recorrer los resultados y agregar los valores a los arrays
    while ($rowModelo = $resultModelo->fetch_assoc()) {
        $modvcCodigo[] = $rowModelo['MODVC_CODIGO'];          // Guardar en el array mvcCodigo
        $modvcDescripcion[] = $rowModelo['MODVC_DESCRIPCION']; // Guardar en el array mvcDescripcion
    }
}

$procedencias = ["E" => 10, "J" => 20, "S" => 80];

foreach ($lineas as $index => $linea) {
    if ($index == 0) continue;
    $datos = explode(";", $linea);
    $procedencia = !empty($datos[0]) ? $datos[0] : '';
    $codEquipoSap = !empty($datos[1]) ? $datos[1] : '';
    $codActivoSap = !empty($datos[2]) ? $datos[2] : '';
    $nroSerie = !empty($datos[3]) ? $datos[3] : '';
    $marca = !empty($datos[7]) ? $datos[7] : '';
    $modelo = !empty($datos[8]) ? $datos[8] : '';

    $procedencia = $procedencias[$datos[0]] ?? '';

    if (!in_array($marca, $mvcDescripcion)) {
        $diferenciaMarca = $marca;
    }


    //chequeamos que el codigo no se repita
    $checkemail_duplicidad = "SELECT VC_COD_EQUIPO_SAP FROM VIDEOCAMARA WHERE VC_COD_EQUIPO_SAP='$codEquipoSap'";
    $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
    $cant_duplicidad = mysqli_num_rows($ca_dupli);

    if ($cant_duplicidad == 0) {
        $insertData[] = "('$marca', '$modelo', '$procedencia', '$codActivoSap', '$codEquipoSap', '$nroSerie')";
    } else {
        $updateData[] = "WHEN VC_COD_EQUIPO_SAP='$codEquipoSap' THEN ('$marca', '$modelo', '$procedencia', '$codActivoSap', '$nroSerie')";
    }
    $i++;
}

if (!empty($insertData)) {
    $insertQuery = "INSERT INTO VIDEOCAMARA (MVC_COD, MODVC_CODIGO, PREC_CODIGO, VC_COD_ACTIVO_SAP, VC_COD_EQUIPO_SAP, VC_NRO_SERIE) VALUES " . implode(", ", $insertData);
    mysqli_query($con, $insertQuery);
}

if (!empty($updateData)) {
    foreach ($updateData as $data) {
        $updateQuery = "UPDATE VIDEOCAMARA SET MVC_COD = '$data[0]', MODVC_CODIGO = '$data[1]', PREC_CODIGO = '$data[2]', VC_COD_ACTIVO_SAP = '$data[3]', VC_NRO_SERIE = '$data[4]' WHERE VC_COD_EQUIPO_SAP = '$data[5]'";
        mysqli_query($con, $updateQuery);
    }
}

?>
<a href="index.php">Volver Atrás</a>