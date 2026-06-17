<?php
 /*   $servidor = "mysql:dbname=DB_PROSERVIPOL_V3;host=DB_PROSERVIPOL_V3";
    $user = "proservipolv3";
    $pass = "carta77";
    try {
        $pdo = new PDO($servidor, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOException $e) {
        echo "conexion fallida" .$e->getMessage();
    }
*/
//echo extension_loaded('php_pdo_mssql') ? 'yes':'no';
//print_r(get_loaded_extensions());

echo 'php.ini: ', get_cfg_var('cfg_file_path');

    $servidor = 'mysql:dbname=DB_PROSERVIPOL_V3;host=DB_PROSERVIPOL_V3';
    $usuario = 'proservipolv3';
    $contraseña = 'carta77';

    try {
        $pdo = new PDO($servidor, $usuario, $contraseña);
    } catch (PDOException $e) {
        echo 'Fallo en la conexion: ' . $e->getMessage();
    }

?>
