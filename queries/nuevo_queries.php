<?php
require_once "config.php";

// Validar que se recibió POST
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos
    $nombre  = isset($_POST['nombre']) ? mysql_real_escape_string($_POST['nombre']) : '';
    $perfil  = isset($_POST['perfil']) ? mysql_real_escape_string($_POST['perfil']) : '';
    $unidad  = isset($_POST['unidad']) ? mysql_real_escape_string($_POST['unidad']) : '';
    $usuario = isset($_POST['usuario']) ? mysql_real_escape_string($_POST['usuario']) : '';
    $clave   = isset($_POST['clave']) ? mysql_real_escape_string($_POST['clave']) : '';

    if (empty($nombre) || empty($correo) || empty($usuario) || empty($clave)) {
        echo "Faltan campos obligatorios.";
        exit;
    }

    // Encriptar contraseña con MD5 (no es seguro, pero es lo que había en 5.1.2)
    $clave_md5 = md5($clave);

    // Insertar datos
    $sql = "INSERT INTO usuarios (nombre, perfil, unidad, usuario, clave) 
            VALUES ('$nombre', '$correo', '$perfil', '$unidad', '$usuario', '$clave_md5')";

    $resultado = mysql_query($sql);

    if ($resultado) {
        echo "ok";
    } else {
        echo "Error al insertar usuario: " . mysql_error();
    }
} else {
    echo "Método no permitido.";
}
    */
