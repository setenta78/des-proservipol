<?php
require_once "config.php";

$param_term = isset($_REQUEST['term']) ? $_REQUEST['term'] : '';

if ($param_term != '') {
    $param_term = escape($param_term); // función de config.php para mysql o mysqli
    $sqlUnidad = "SELECT UNI_CODIGO, UNI_DESCRIPCION 
                  FROM VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS
                  WHERE UNI_DESCRIPCION LIKE '%$param_term%'";
    $result = ejecutar($sqlUnidad);

    if ($result && filas($result) > 0) {
        while ($row = obtener_array($result)) {
            echo "<p data-id='" . $row["UNI_CODIGO"] . "'>" . $row["UNI_DESCRIPCION"] . " - COD: " . $row["UNI_CODIGO"] . "</p>";
        }
    } else {
        echo "<p>No se encontraron coincidencias</p>";
    }
}
