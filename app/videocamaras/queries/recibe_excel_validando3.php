<?php
require('config.php');

// DATA DEL ARCHIVO
$archivotmp = $_FILES['dataCamara']['tmp_name'];
$tipo       = $_FILES['dataCamara']['type'];
$tamanio    = $_FILES['dataCamara']['size'];
$lineas     = file($archivotmp);
//echo "Nombre: " . $archivotmp;

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

/*----------------------------------------------------------------------------------*/
// Seleccionar actuales datos de la tabla MARCA_VIDEOCAMARA
$sqlMarca = "SELECT MVC_CODIGO, MVC_DESCRIPCION FROM MARCA_VIDEOCAMARA";
$resultMarca = $link->query($sqlMarca);

if ($resultMarca && $resultMarca->num_rows > 0) {
    // Recorrer los resultados
    while ($rowMarca = $resultMarca->fetch_assoc()) {
        $mvcCodigo[] = $rowMarca['MVC_CODIGO'];
        $mvcDescripcion[] = $rowMarca['MVC_DESCRIPCION'];
    }
    $ultimoCodigoMarca = end($mvcCodigo);
}
$nuevoCodigoMarca = $ultimoCodigoMarca + 10;
//echo "Nuevo Codigo marca: " . $nuevoCodigoMarca;
/*----------------------------------------------------------------------------------*/
// Seleccionar actuales datos de la tabla MODELO_VIDEOCAMARA
$sqlModelo = "SELECT MODVC_CODIGO, MODVC_DESCRIPCION FROM MODELO_VIDEOCAMARA";
$resultModelo = $link->query($sqlModelo);

if ($resultModelo && $resultModelo->num_rows > 0) {
    // Recorrer los resultados y agregar los valores a los arrays
    while ($rowModelo = $resultModelo->fetch_assoc()) {
        $modvcCodigo[] = $rowModelo['MODVC_CODIGO'];
        $modvcDescripcion[] = $rowModelo['MODVC_DESCRIPCION'];
    }
    $ultimoCodigoModelo = end($modvcCodigo);
    //echo "El último código modelo es: " . $ultimoCodigoModelo;
}
$nuevoCodigoModelo = $ultimoCodigoModelo + 10;
//echo "Nuevo Codigo modelo: " . $nuevoCodigoModelo;
/*----------------------------------------------------------------------------------*/
//BUSCAR ÚLTIMO VALOR DE "VC_CODIGO" PARA PODER INGRESAR EL NUEVO CÓDIGO DE CAMARAS
function obtenerUltimoCodigoVC($link)
{
    // variable estática para almacenar el último código
    static $ultimoCodigo = null;

    if ($ultimoCodigo === null) {
        // Si es la primera vez que se llama, obtener el último código de la base de datos
        $sql = "SELECT MAX(VC_CODIGO) AS ultimoCodigo FROM VIDEOCAMARA";
        $result = mysqli_query($link, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $ultimoCodigo = $row['ultimoCodigo'];
        } else {
            echo "Error al obtener el último código: " . mysqli_error($link);
            return null; // Manejo de error si la consulta falla
        }
    }
    // Sumar 10 al último código y retornarlo
    $ultimoCodigo += 10;
    return $ultimoCodigo;
}
/*----------------------------------------------------------------------------------*/
// Procesar archivo línea por línea
foreach ($lineas as $index => $linea) {
    if ($index == 0) continue; // Saltar la cabecera
    $datos = explode(";", $linea);

    $nuevoCodigoVC = obtenerUltimoCodigoVC($link);
    $procedencia = ($datos[0] == "E") ? 10 : (($datos[0] == "J") ? 20 : 80);
    $codEquipoSap = $datos[1] ?? '';
    // $codActivoSap = !empty($datos[2]) ? "'{$datos[2]}'" : 'NULL';
    $codActivoSap = $datos[2] ?? 'NULL';
    $nroSerie = $datos[3] ?? '';
    $marca = $datos[7] ?? '';
    $modelo = $datos[8] ?? '';

    /* echo "<pre>";
    print_r($nuevoCodigoVC);
    echo "</pre>";*/

    // Buscar si la marca está en $mvcDescripcion
    $key = array_search($marca, $mvcDescripcion);
    if ($key !== false) {
        // Si se encuentra la marca, cambiar el valor de $marca al código correspondiente
        $marcaCod = $mvcCodigo[$key];
    }

    // Si la marca no existe, insertarla
    if (!in_array($marca, $mvcDescripcion)) {
        $sqlInsertMarca = "INSERT INTO MARCA_VIDEOCAMARA (MVC_CODIGO, MVC_DESCRIPCION) VALUES ('$nuevoCodigoMarca', '$marca')";
        if (!mysqli_query($link, $sqlInsertMarca)) {
            echo "Error al insertar la marca '$marca': " . mysqli_error($link) . "<br>";
        } else {
            echo "La marca '$marca' ha sido insertada con el código $nuevoCodigoMarca.<br>";
            $mvcCodigo[] = $nuevoCodigoMarca;
            $mvcDescripcion[] = $marca;
        }
    }

    // Buscar si el modelo está en $modvcDescripcion
    $key = array_search($modelo, $modvcDescripcion);
    if ($key !== false) {
        // Si se encuentra la marca, cambiar el valor de $modelo al código correspondiente
        $modeloCod = $modvcCodigo[$key];
    }

    // Si el modelo no existe, insertarlo
    if (!in_array($modelo, $modvcDescripcion)) {
        $sqlInsertModelo = "INSERT INTO MODELO_VIDEOCAMARA (MODVC_CODIGO, MODVC_DESCRIPCION) VALUES ('$nuevoCodigoModelo', '$modelo')";
        if (!mysqli_query($link, $sqlInsertModelo)) {
            echo "Error al insertar el modelo '$modelo': " . mysqli_error($link) . "<br>";
        } else {
            echo "El modelo '$modelo' ha sido insertado con el código $nuevoCodigoModelo.<br>";
            $modvcCodigo[] = $nuevoCodigoModelo;
            $modvcDescripcion[] = $modelo;
        }
    }

    // Verificar si ya existe en BD para no duplicar
    $checkDuplicidad = "SELECT VC_COD_EQUIPO_SAP FROM VIDEOCAMARA WHERE VC_COD_EQUIPO_SAP='$codEquipoSap'";
    $resultDuplicidad = mysqli_query($link, $checkDuplicidad);
    $cantDuplicidad = mysqli_num_rows($resultDuplicidad);

    if ($cantDuplicidad == 0) {
        $insertData[] = "('$nuevoCodigoVC', '$marcaCod', '$modeloCod', '$procedencia', '$codActivoSap', '$codEquipoSap', '$nroSerie')";
    } else {
        // Actualizar data existente
        $updateData[] = [
            'marca' => $marcaCod,
            'modelo' => $modeloCod,
            'procedencia' => $procedencia,
            'codActivoSap' => $codActivoSap,
            'nroSerie' => $nroSerie,
            'codEquipoSap' => $codEquipoSap
        ];
    }
}
// Inserción de datos
if (!empty($insertData)) {
    $insertQuery = "INSERT INTO VIDEOCAMARA (VC_CODIGO, MVC_CODIGO, MODVC_CODIGO, PREC_CODIGO, VC_COD_ACTIVO_SAP, VC_COD_EQUIPO_SAP, VC_NRO_SERIE) VALUES " . implode(", ", $insertData);
    if (mysqli_query($link, $insertQuery)) {
        echo "Inserción correcta";
    } else {
        echo "Error en la inserción: " . mysqli_error($link);
        // echo $insertQuery;
    }
}
// Actualización de datos
if (!empty($updateData)) {
    foreach ($updateData as $data) {
        $updateQuery = "UPDATE VIDEOCAMARA 
                        SET MVC_CODIGO = '{$data['marca']}', 
                            MODVC_CODIGO = '{$data['modelo']}', 
                            PREC_CODIGO = '{$data['procedencia']}', 
                            VC_COD_ACTIVO_SAP = '{$data['codActivoSap']}', 
                            VC_NRO_SERIE = '{$data['nroSerie']}' 
                        WHERE VC_COD_EQUIPO_SAP = '{$data['codEquipoSap']}'";
        if (!mysqli_query($link, $updateQuery)) {
            echo "Error en la actualización del equipo SAP '{$data['codEquipoSap']}': " . mysqli_error($link);
            echo $updateQuery;
        }
    }
    //echo "Actualización correcta";
}

?>
<a href="http://localhost:8888/app/videocamaras/index.php">Volver Atrás</a>