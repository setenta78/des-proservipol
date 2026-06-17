<?php
require('config.php');

// Verificar archivo
$archivotmp = $_FILES['dataCamara']['tmp_name'];
$tipo       = $_FILES['dataCamara']['type'];
$tamanio    = $_FILES['dataCamara']['size'];

if (empty($archivotmp) || $tipo !== 'text/csv') {
    die("No se ha subido ningún archivo válido");
}

// Inicialización de variables
$updateData = [];
$insertData = [];
$mvcMap = [];
$modvcMap = [];

// Función para obtener el último código de cámara
function obtenerUltimoCodigoVC($link)
{
    static $ultimoCodigo = null;

    if ($ultimoCodigo === null) {
        $sql = "SELECT MAX(VC_CODIGO) AS ultimoCodigo FROM VIDEOCAMARA";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $ultimoCodigo = $row['ultimoCodigo'] ?? 0;
        } else {
            die("Error al obtener el último código: " . mysqli_error($link));
        }
    }
    return $ultimoCodigo += 10;
}

// Cargar datos de las tablas MARCA_VIDEOCAMARA y MODELO_VIDEOCAMARA
function cargarDatosExistentes($link, &$mvcMap, &$modvcMap)
{
    $resultMarca = $link->query("SELECT MVC_CODIGO, MVC_DESCRIPCION FROM MARCA_VIDEOCAMARA");
    while ($row = $resultMarca->fetch_assoc()) {
        $mvcMap[$row['MVC_DESCRIPCION']] = $row['MVC_CODIGO'];
    }

    $resultModelo = $link->query("SELECT MODVC_CODIGO, MODVC_DESCRIPCION FROM MODELO_VIDEOCAMARA");
    while ($row = $resultModelo->fetch_assoc()) {
        $modvcMap[$row['MODVC_DESCRIPCION']] = $row['MODVC_CODIGO'];
    }
}

// Inserción de marcas y modelos
function insertarMarcaModelo($link, $descripcion, &$map, $tabla, $campoCodigo, $campoDescripcion)
{
    $nuevoCodigo = max($map) + 10;
    $sqlInsert = $link->prepare("INSERT INTO $tabla ($campoCodigo, $campoDescripcion) VALUES (?, ?)");
    $sqlInsert->bind_param('is', $nuevoCodigo, $descripcion);

    if ($sqlInsert->execute()) {
        $map[$descripcion] = $nuevoCodigo;
        return $nuevoCodigo;
    } else {
        die("Error al insertar en $tabla: " . $sqlInsert->error);
    }
}

// Cargar datos de marca y modelo
cargarDatosExistentes($link, $mvcMap, $modvcMap);

// Procesar el archivo CSV
if (($handle = fopen($archivotmp, "r")) !== FALSE) {
    fgetcsv($handle, 1000, ";"); // Saltar cabecera

    while (($datos = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $nuevoCodigoVC = obtenerUltimoCodigoVC($link);
        $procedencia = ($datos[0] == "E") ? 10 : (($datos[0] == "J") ? 20 : 80);
        $codEquipoSap = $datos[1] ?? '';
        $codActivoSap = $datos[2] ?? 'NULL';
        $nroSerie = $datos[3] ?? '';
        $marca = $datos[7] ?? '';
        $modelo = $datos[8] ?? '';

        // Procesar marca
        if (!isset($mvcMap[$marca])) {
            $marcaCod = insertarMarcaModelo($link, $marca, $mvcMap, 'MARCA_VIDEOCAMARA', 'MVC_CODIGO', 'MVC_DESCRIPCION');
        } else {
            $marcaCod = $mvcMap[$marca];
        }

        // Procesar modelo
        if (!isset($modvcMap[$modelo])) {
            $modeloCod = insertarMarcaModelo($link, $modelo, $modvcMap, 'MODELO_VIDEOCAMARA', 'MODVC_CODIGO', 'MODVC_DESCRIPCION');
        } else {
            $modeloCod = $modvcMap[$modelo];
        }

        // Verificar duplicidad
        $checkDuplicidad = $link->prepare("SELECT VC_COD_EQUIPO_SAP FROM VIDEOCAMARA WHERE VC_COD_EQUIPO_SAP = ?");
        $checkDuplicidad->bind_param('s', $codEquipoSap);
        $checkDuplicidad->execute();
        $checkDuplicidad->store_result();

        if ($checkDuplicidad->num_rows == 0) {
            $insertData[] = "('$nuevoCodigoVC', '$marcaCod', '$modeloCod', '$procedencia', '$codActivoSap', '$codEquipoSap', '$nroSerie')";
        } else {
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
    fclose($handle);
}

// Inserción masiva de datos
if (!empty($insertData)) {
    $insertQuery = "INSERT INTO VIDEOCAMARA (VC_CODIGO, MVC_CODIGO, MODVC_CODIGO, PREC_CODIGO, VC_COD_ACTIVO_SAP, VC_COD_EQUIPO_SAP, VC_NRO_SERIE) VALUES " . implode(", ", $insertData);
    if (!$link->query($insertQuery)) {
        die("Error en la inserción: " . $link->error);
    }
}

// Actualización masiva de datos
if (!empty($updateData)) {
    foreach ($updateData as $data) {
        $updateQuery = $link->prepare("UPDATE VIDEOCAMARA 
                                        SET MVC_CODIGO = ?, 
                                            MODVC_CODIGO = ?, 
                                            PREC_CODIGO = ?, 
                                            VC_COD_ACTIVO_SAP = ?, 
                                            VC_NRO_SERIE = ? 
                                        WHERE VC_COD_EQUIPO_SAP = ?");
        $updateQuery->bind_param('iiisss', $data['marca'], $data['modelo'], $data['procedencia'], $data['codActivoSap'], $data['nroSerie'], $data['codEquipoSap']);
        if (!$updateQuery->execute()) {
            die("Error en la actualización del equipo SAP '{$data['codEquipoSap']}': " . $updateQuery->error);
        }
    }
}

echo "Operación completada correctamente.";


?>
<a href="http://localhost:8888/app/videocamaras/index.php">Volver Atrás</a>