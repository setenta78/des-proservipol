<?php
require('config.php');

// DATA DEL ARCHIVO
$archivotmp = $_FILES['dataCamara']['tmp_name'];
$tipo       = $_FILES['dataCamara']['type'];
$tamanio    = $_FILES['dataCamara']['size'];
$lineas     = file($archivotmp);

if (empty($archivotmp) || $tipo !== 'text/csv') {
    die("No se ha subido ningún archivo válido");
}

// Declaro variables
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
if ($resultMarca && $resultMarca->num_rows > 0) {
    // Recorrer los resultados y agregar los valores a los arrays
    while ($rowMarca = $resultMarca->fetch_assoc()) {
        $mvcCodigo[] = $rowMarca['MVC_CODIGO'];
        $mvcDescripcion[] = $rowMarca['MVC_DESCRIPCION'];
    }
}

// Consulta SQL para seleccionar los datos de la tabla MODELO_VIDEOCAMARA
$sqlModelo = "SELECT MODVC_CODIGO, MODVC_DESCRIPCION FROM MODELO_VIDEOCAMARA";
$resultModelo = $con->query($sqlModelo);

// Verificar si se obtuvieron resultados
if ($resultModelo && $resultModelo->num_rows > 0) {
    // Recorrer los resultados y agregar los valores a los arrays
    while ($rowModelo = $resultModelo->fetch_assoc()) {
        $modvcCodigo[] = $rowModelo['MODVC_CODIGO'];
        $modvcDescripcion[] = $rowModelo['MODVC_DESCRIPCION'];
    }
}

// Mapear procedencias
$procedencias = ["E" => 10, "J" => 20, "S" => 80];

// Procesar archivo línea por línea
foreach ($lineas as $index => $linea) {
    if ($index == 0) continue; // Saltar la cabecera

    $datos = explode(";", $linea);
    $procedencia = $procedencias[$datos[0]] ?? '';
    $codEquipoSap = $datos[1] ?? '';
    $codActivoSap = $datos[2] ?? '';
    $nroSerie = $datos[3] ?? '';
    $marca = $datos[7] ?? '';
    $modelo = $datos[8] ?? '';

    // Si la marca no existe, insertarla en la tabla MARCA_VIDEOCAMARA
    if (!in_array($marca, $mvcDescripcion)) {

        // Obtener el último valor de MVC_COD en la tabla MARCA_VIDEOCAMARA
        $sqlUltimoCod = "SELECT MAX(MVC_CODIGO) AS ultimoCodigo FROM MARCA_VIDEOCAMARA";
        $resultUltimoCod = mysqli_query($con, $sqlUltimoCod);

        if ($resultUltimoCod) {
            $rowUltimoCod = mysqli_fetch_assoc($resultUltimoCod);
            $nuevoCodigo = $rowUltimoCod['ultimoCodigo'] + 10; // Sumar 10 al último valor
        } else {
            // En caso de que no haya registros, asignar un código inicial
            $nuevoCodigo = 10;
        }

        // Insertar la nueva marca en la tabla MARCA_VIDEOCAMARA
        $sqlInsertMarca = "INSERT INTO MARCA_VIDEOCAMARA (MVC_CODIGO, MVC_DESCRIPCION) VALUES ('$nuevoCodigo', '$marca')";
        if (mysqli_query($con, $sqlInsertMarca)) {
            echo "La marca '$marca' ha sido insertada en la base de datos con el código $nuevoCodigo.<br>";
            // Añadir la nueva marca a los arrays locales para evitar duplicados en el mismo proceso
            $mvcCodigo[] = $nuevoCodigo;
            $mvcDescripcion[] = $marca;
        } else {
            echo "Error al insertar la marca '$marca' en la base de datos: " . mysqli_error($con) . "<br>";
        }
    }

    // Si modelo no existe, insertarlo en la tabla MODELO_VIDEOCAMARA
    if (!in_array($modelo, $modvcDescripcion)) {

        // Obtener el último valor de MVC_COD en la tabla MODELO_VIDEOCAMARA
        $sqlUltimoCod = "SELECT MAX(MODVC_CODIGO) AS ultimoCodigo FROM MODELO_VIDEOCAMARA";
        $resultUltimoCod = mysqli_query($con, $sqlUltimoCod);

        if ($resultUltimoCod) {
            $rowUltimoCod = mysqli_fetch_assoc($resultUltimoCod);
            $nuevoCodigo = $rowUltimoCod['ultimoCodigo'] + 10; // Sumar 10 al último valor
        } else {
            // En caso de que no haya registros, asignar un código inicial
            $nuevoCodigo = 10;
        }

        // Insertar el nuevo modelo en la tabla MODELO_VIDEOCAMARA
        $sqlInsertModelo = "INSERT INTO MODELO_VIDEOCAMARA (MODVC_CODIGO, MODVC_DESCRIPCION) VALUES ('$nuevoCodigo', '$modelo')";
        if (mysqli_query($con, $sqlInsertModelo)) {
            echo "El modelo '$modelo' ha sido insertada en la base de datos con el código $nuevoCodigo.<br>";
            // Añadir el nuevo modelo a los arrays locales para evitar duplicados en el mismo proceso
            $modvcCodigo[] = $nuevoCodigo;
            $modvcDescripcion[] = $modelo;
        } else {
            echo "Error al insertar la marca '$modelo' en la base de datos: " . mysqli_error($con) . "<br>";
        }
    }


    // Verificar duplicidad del código de equipo SAP
    $checkDuplicidad = "SELECT VC_COD_EQUIPO_SAP FROM VIDEOCAMARA WHERE VC_COD_EQUIPO_SAP='$codEquipoSap'";
    $resultDuplicidad = mysqli_query($con, $checkDuplicidad);
    $cantDuplicidad = mysqli_num_rows($resultDuplicidad);

    if ($cantDuplicidad == 0) {
        // Insertar nueva data
        $insertData[] = "('$marca', '$modelo', '$procedencia', '$codActivoSap', '$codEquipoSap', '$nroSerie')";
    } else {
        // Actualizar data existente
        $updateData[] = [
            'marca' => $marca,
            'modelo' => $modelo,
            'procedencia' => $procedencia,
            'codActivoSap' => $codActivoSap,
            'nroSerie' => $nroSerie,
            'codEquipoSap' => $codEquipoSap
        ];
    }
}

// Inserción en la base de datos
if (!empty($insertData)) {
    $insertQuery = "INSERT INTO VIDEOCAMARA (MVC_COD, MODVC_CODIGO, PREC_CODIGO, VC_COD_ACTIVO_SAP, VC_COD_EQUIPO_SAP, VC_NRO_SERIE) VALUES " . implode(", ", $insertData);
    mysqli_query($con, $insertQuery);
}

// Actualización en la base de datos
if (!empty($updateData)) {
    foreach ($updateData as $data) {
        $updateQuery = "UPDATE VIDEOCAMARA 
            SET MVC_COD = '{$data['marca']}', 
                MODVC_CODIGO = '{$data['modelo']}', 
                PREC_CODIGO = '{$data['procedencia']}', 
                VC_COD_ACTIVO_SAP = '{$data['codActivoSap']}', 
                VC_NRO_SERIE = '{$data['nroSerie']}' 
            WHERE VC_COD_EQUIPO_SAP = '{$data['codEquipoSap']}'";
        mysqli_query($con, $updateQuery);
    }
}
?>
<a href="index.php">Volver Atrás</a>