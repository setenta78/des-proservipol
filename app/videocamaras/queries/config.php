<?php

define('DB_SERVER', '172.21.111.67');
define('DB_USERNAME', 'proservipolv3');
define('DB_PASSWORD', 'carta77');
define('DB_NAME', 'DB_PROSERVIPOL_V3');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

/*
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'DB_PROSERVIPOL_V3');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    // echo "conexion ok";
}*/
