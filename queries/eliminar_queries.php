<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];

    echo eliminarUsuario($codigo);
}

function eliminarUsuario($codigo)
{
    // Validación estricta: que no estén vacíos pero sí acepten 0 como válido
    if ($codigo === '') {
        return "Faltan datos";
    }
    // Escapar datos usando la conexión activa
    $codigo = mysql_real_escape_string($codigo);

    // Construir SQL
    $sql = "UPDATE USUARIO SET US_ACTIVO = '0' WHERE FUN_CODIGO = '$codigo'";

    // DEPURAR AQUÍ
    /*   echo "Código recibido: '$codigo'<br>";
    echo "Consulta SQL: $sql<br>";
*/
    $res = mysql_query($sql);

    if (!$res) {
        return "Error al actualizar: " . mysql_error();
    }

    // Verificar si realmente se actualizó algo
    if (mysql_affected_rows() > 0) {
        return "Usuario eliminado correctamente";
    } else {
        return "No se eliminó un usuario";
    }
}
