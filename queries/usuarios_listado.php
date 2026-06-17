<?php
// queries/usuarios_listado.php

// Esta función retorna el resultado mysql_query con el listado y datos ya filtrados y paginados
function obtenerUsuarios($link, $search, $sort, $order, $offset, $records_per_page)
{
    // Escape - usando mysql_real_escape_string
    $search_safe = mysql_real_escape_string($search);

    // Consulta SQL (igual que antes)
    $sql = "SELECT 
                FUNCIONARIO.FUN_CODIGO,
                FUNCIONARIO.FUN_NOMBRE,
                IFNULL(FUNCIONARIO.FUN_NOMBRE2, '') AS FUN_NOMBRE2,
                FUNCIONARIO.FUN_APELLIDOPATERNO,
                FUNCIONARIO.FUN_APELLIDOMATERNO,
                GRADO.GRA_DESCRIPCION,
                IF(CARGO_FUNCIONARIO.UNI_AGREGADO, CONCAT(CARGO.CAR_DESCRIPCION, ' A ', UNIDAD.UNI_DESCRIPCION), CARGO.CAR_DESCRIPCION) AS CARGO,
                VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.ZONA_DESCRIPCION,
                VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.PREFECTURA_DESCRIPCION,
                VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.COMISARIA_DESCRIPCION,
                VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.UNI_DESCRIPCION,
                TIPO_USUARIO.TUS_DESCRIPCION,
                IFNULL(CAPACITACION.TIPO_CAPACITACION, 'SIN CURSO') AS CAPACITACION,
                CAPACITACION.NOTA_PROSERVIPOL,
                CAPACITACION.FECHA_CAPACITACION
            FROM CARGO_FUNCIONARIO
            JOIN FUNCIONARIO ON CARGO_FUNCIONARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO
            JOIN GRADO ON FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO 
                AND FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO
            JOIN CARGO ON CARGO.CAR_CODIGO = CARGO_FUNCIONARIO.CAR_CODIGO 
                AND CARGO.CAR_CODIGO != 3500
            LEFT JOIN UNIDAD ON UNIDAD.UNI_CODIGO = CARGO_FUNCIONARIO.UNI_AGREGADO
            INNER JOIN USUARIO ON USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO
            INNER JOIN TIPO_USUARIO ON TIPO_USUARIO.TUS_CODIGO = USUARIO.TUS_CODIGO
            LEFT JOIN CAPACITACION ON CAPACITACION.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO 
                AND CAPACITACION.ACTIVO = 1
            JOIN VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS 
                ON USUARIO.UNI_CODIGO = VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.UNI_CODIGO
            WHERE CARGO_FUNCIONARIO.FECHA_HASTA IS NULL
                AND (USUARIO.FUN_CODIGO LIKE '%$search_safe%' 
                    OR FUNCIONARIO.FUN_APELLIDOPATERNO LIKE '%$search_safe%' 
                    OR FUNCIONARIO.FUN_APELLIDOMATERNO LIKE '%$search_safe%' 
                    OR FUNCIONARIO.FUN_NOMBRE LIKE '%$search_safe%' 
                    OR VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.UNI_DESCRIPCION LIKE '%$search_safe%' 
                    OR TIPO_USUARIO.TUS_DESCRIPCION LIKE '%$search_safe%')
                    AND USUARIO.US_ACTIVO =1
            ORDER BY $sort $order
            LIMIT $records_per_page OFFSET $offset";

    return mysql_query($sql, $link);
}

// Para el conteo total (paginación)
function contarUsuarios($link)
{
    $count_sql = "SELECT COUNT(*) AS total
                    FROM USUARIO
                    INNER JOIN FUNCIONARIO ON USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO
                    INNER JOIN TIPO_USUARIO ON USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO
                    INNER JOIN UNIDAD ON USUARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO WHERE USUARIO.US_ACTIVO = 1";

    $count_result = mysql_query($count_sql, $link);
    if (!$count_result) {
        die("Error en la consulta: " . mysql_error());
    }
    $row = mysql_fetch_assoc($count_result);
    mysql_free_result($count_result);
    return isset($row['total']) ? $row['total'] : 0;
}

function obtenerUsuariosParametricos($link, $apellido1, $apellido2, $nombre1, $nombre2, $unidades, $perfiles, $sort, $order, $offset, $records_per_page)
{
    $where = "CARGO_FUNCIONARIO.FECHA_HASTA IS NULL";

    // Filtros de nombres
    if ($apellido1 != '') {
        $apellido1 = mysql_real_escape_string($apellido1);
        $where .= " AND FUNCIONARIO.FUN_APELLIDOPATERNO LIKE '%$apellido1%'";
    }
    if ($apellido2 != '') {
        $apellido2 = mysql_real_escape_string($apellido2);
        $where .= " AND FUNCIONARIO.FUN_APELLIDOMATERNO LIKE '%$apellido2%'";
    }
    if ($nombre1 != '') {
        $nombre1 = mysql_real_escape_string($nombre1);
        $where .= " AND FUNCIONARIO.FUN_NOMBRE LIKE '%$nombre1%'";
    }
    if ($nombre2 != '') {
        $nombre2 = mysql_real_escape_string($nombre2);
        $where .= " AND FUNCIONARIO.FUN_NOMBRE2 LIKE '%$nombre2%'";
    }

    // Filtro de unidades
    if ($unidades != '') {
        $ids = explode(',', $unidades);
        $ids = array_map('intval', $ids);
        if (count($ids) > 0) {
            $where .= " AND VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.UNI_CODIGO IN (" . implode(',', $ids) . ")";
        }
    }

    // Filtro de perfiles
    if (!empty($perfiles) && is_array($perfiles)) {
        $ids = array_map('intval', $perfiles);
        if (count($ids) > 0) {
            $where .= " AND USUARIO.TUS_CODIGO IN (" . implode(',', $ids) . ")";
        }
    }

    // Validación de orden
    $allowed_sort_columns = array(
        'FUN_CODIGO',
        'FUN_APELLIDOPATERNO',
        'FUN_APELLIDOMATERNO',
        'FUN_NOMBRE',
        'GRA_DESCRIPCION',
        'CARGO',
        'UNI_DESCRIPCION',
        'TUS_DESCRIPCION',
        'CAPACITACION'
    );

    $sort  = in_array($sort, $allowed_sort_columns) ? $sort : 'FUN_CODIGO';
    $order = ($order === 'desc') ? 'desc' : 'asc';
    $new_order = ($order === 'asc') ? 'desc' : 'asc';

    // Armar SQL
    $sql = "SELECT 
                FUNCIONARIO.FUN_CODIGO,
                FUNCIONARIO.FUN_NOMBRE,
                IFNULL(FUNCIONARIO.FUN_NOMBRE2, '') AS FUN_NOMBRE2,
                FUNCIONARIO.FUN_APELLIDOPATERNO,
                FUNCIONARIO.FUN_APELLIDOMATERNO,
                GRADO.GRA_DESCRIPCION,
                IF(CARGO_FUNCIONARIO.UNI_AGREGADO, CONCAT(CARGO.CAR_DESCRIPCION, ' A ', UNIDAD.UNI_DESCRIPCION), CARGO.CAR_DESCRIPCION) AS CARGO,
                VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.ZONA_DESCRIPCION,
                VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.PREFECTURA_DESCRIPCION,
                VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.COMISARIA_DESCRIPCION,
                VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.UNI_DESCRIPCION,
                TIPO_USUARIO.TUS_DESCRIPCION,
                IFNULL(CAPACITACION.TIPO_CAPACITACION, 'SIN CURSO') AS CAPACITACION,
                CAPACITACION.NOTA_PROSERVIPOL,
                CAPACITACION.FECHA_CAPACITACION
            FROM CARGO_FUNCIONARIO
            JOIN FUNCIONARIO ON CARGO_FUNCIONARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO
            JOIN GRADO ON FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO 
                AND FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO
            JOIN VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS 
                ON CARGO_FUNCIONARIO.UNI_CODIGO = VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.UNI_CODIGO
            JOIN CARGO ON CARGO.CAR_CODIGO = CARGO_FUNCIONARIO.CAR_CODIGO 
                AND CARGO.CAR_CODIGO != 3500
            LEFT JOIN UNIDAD ON UNIDAD.UNI_CODIGO = CARGO_FUNCIONARIO.UNI_AGREGADO
            INNER JOIN USUARIO ON USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO
            INNER JOIN TIPO_USUARIO ON TIPO_USUARIO.TUS_CODIGO = USUARIO.TUS_CODIGO
            LEFT JOIN CAPACITACION ON CAPACITACION.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO 
                AND CAPACITACION.ACTIVO = 1
            WHERE $where
            ORDER BY $sort $order
            LIMIT $records_per_page OFFSET $offset";

    // echo "<pre>$sql</pre>";
    //   exit;
    // return mysql_query($sql, $link); // puedes añadir or die(mysql_error());
    $result = mysql_query($sql, $link) or die("Error SQL: " . mysql_error() . " -- Consulta: $sql");
    return $result;
}


function contarUsuariosParametricos($link, $apellido1, $apellido2, $nombre1, $nombre2, $unidades, $perfiles)
{
    $where = "CARGO_FUNCIONARIO.FECHA_HASTA IS NULL";

    // Filtros de nombres
    if ($apellido1 != '') {
        $apellido1 = mysql_real_escape_string($apellido1);
        $where .= " AND FUNCIONARIO.FUN_APELLIDOPATERNO LIKE '%$apellido1%'";
    }
    if ($apellido2 != '') {
        $apellido2 = mysql_real_escape_string($apellido2);
        $where .= " AND FUNCIONARIO.FUN_APELLIDOMATERNO LIKE '%$apellido2%'";
    }
    if ($nombre1 != '') {
        $nombre1 = mysql_real_escape_string($nombre1);
        $where .= " AND FUNCIONARIO.FUN_NOMBRE LIKE '%$nombre1%'";
    }
    if ($nombre2 != '') {
        $nombre2 = mysql_real_escape_string($nombre2);
        $where .= " AND FUNCIONARIO.FUN_NOMBRE2 LIKE '%$nombre2%'";
    }

    // Filtro de unidades (array de IDs separados por coma)
    if ($unidades != '') {
        $ids = explode(',', $unidades);
        $ids = array_map('intval', $ids);
        if (count($ids) > 0) {
            $where .= " AND VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.UNI_CODIGO IN (" . implode(',', $ids) . ")";
        }
    }

    // Filtro de perfiles (array de IDs separados por coma)
    if (!empty($perfiles) && is_array($perfiles)) {
        $ids = array_map('intval', $perfiles);
        if (count($ids) > 0) {
            $where .= " AND USUARIO.TUS_CODIGO IN (" . implode(',', $ids) . ")";
        }
    }

    $sql = "SELECT COUNT(DISTINCT FUNCIONARIO.FUN_CODIGO) AS total
            FROM CARGO_FUNCIONARIO
            JOIN FUNCIONARIO ON CARGO_FUNCIONARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO
            JOIN GRADO ON FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO 
                AND FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO
            JOIN VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS 
                ON CARGO_FUNCIONARIO.UNI_CODIGO = VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS.UNI_CODIGO
            JOIN CARGO ON CARGO.CAR_CODIGO = CARGO_FUNCIONARIO.CAR_CODIGO 
                AND CARGO.CAR_CODIGO != 3500
            LEFT JOIN UNIDAD ON UNIDAD.UNI_CODIGO = CARGO_FUNCIONARIO.UNI_AGREGADO
            INNER JOIN USUARIO ON USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO
            INNER JOIN TIPO_USUARIO ON TIPO_USUARIO.TUS_CODIGO = USUARIO.TUS_CODIGO
            LEFT JOIN CAPACITACION ON CAPACITACION.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO 
                AND CAPACITACION.ACTIVO = 1
            WHERE $where";

    $result = mysql_query($sql, $link);
    if (!$result) {
        die("Error en la consulta: " . mysql_error());
    }

    $row = mysql_fetch_assoc($result);
    mysql_free_result($result);

    //  echo "<pre>$sql</pre>";

    return isset($row['total']) ? (int)$row['total'] : 0;
}
