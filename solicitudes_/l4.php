<?php
// Creamos la conexion
$conexion = mysql_connect("168.88.13.5", "ap_proservipol", "@ap@");

// Generamos la consulta
mysql_select_db("DB_L4", $conexion);
$query = "SELECT 
          CODIGO_ANIMAL,
          NOMBRE_ANIMAL,
          FECHA_NACIMIENTO
          FROM 
          animales
          LIMIT 5";
          
// Enviamos la consulta a MySQL
$queEmp = mysql_query($query, $conexion) or die(mysql_error());

// Mostramos los datos
while ($resEmp = mysql_fetch_assoc($queEmp)) {
    $a1=$resEmp['CODIGO_ANIMAL'];
    $a2=$resEmp['NOMBRE_ANIMAL'];
    $a3=$resEmp['FECHA_NACIMIENTO'];
    
    echo $a1;
    echo "<br>";
    echo $a2;
    echo "<br>";
    echo $a3;  
}
// Cerramos la conexion
mysql_close($conexion);
?>