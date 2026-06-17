<?php
require_once "config.php";

function obtenerPerfiles()
{
    $sql = "SELECT TUS_CODIGO, TUS_DESCRIPCION 
            FROM TIPO_USUARIO WHERE
            TIPO_USUARIO.TUS_ACTIVO = 1";
    $res = ejecutar($sql);
    $datos = array();
    while ($row = mysql_fetch_assoc($res)) {
        $datos[] = $row;
    }
    return $datos;
}

function obtenerUnidades()
{
    $sql = "SELECT UNI_CODIGO, UNI_DESCRIPCION 
            FROM VISTA_ARBOL_UNIDADES_NACIONAL_CON_PREFECTURAS";
    $res = ejecutar($sql);
    $datos = array();
    while ($row = mysql_fetch_assoc($res)) {
        $datos[] = $row;
    }
    return $datos;
}
