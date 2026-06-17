<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', '172.21.111.67');
define('DB_USERNAME', 'proservipolv3');
define('DB_PASSWORD', 'carta77');
define('DB_NAME', 'DB_PROSERVIPOL_V3');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>