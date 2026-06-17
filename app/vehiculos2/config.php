<?php
$host = "172.21.111.67";
$username = "proservipolv3";
$password = "carta77";
$dbname = "DB_PROSERVIPOL_V3";

$link = mysqli_connect($host, $username, $password, $dbname);

if ($link === false) {
    die("ERROR: No se pudo conectar a la base de datos. " . mysqli_connect_error());
}
