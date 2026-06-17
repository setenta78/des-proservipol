<?php
// http://programarenphp.wordpress.com


/******** CONECTAR CON BASE DE DATOS **************** */ 
/******** Recuerda cambiar por tus datos ***********/  
   $con = mysql_connect("host","usuario","contraseña");
   if (!$con){die('ERROR DE CONEXION CON MYSQL: ' . mysql_error());} 
/* ********************************************** */

/********* CONECTA CON LA BASE DE DATOS  **************** */
   $database = mysql_select_db("almacen",$con);
   if (!$database){die('ERROR CONEXION CON BD: '.mysql_error());}
/* ********************************************** */

//ejecutamos la consulta
$sql = "SELECT nombre, precio, existencia FROM productos WHERE codigo='"
      .$_POST['codigo']."'";
$result = mysql_query ($sql);
// verificamos que no haya error 
if (! $result){
   echo "La consulta SQL contiene errores.".mysql_error();
   exit();
}else {
    echo "<table border='1'><tr><td>Nombre</td><td>Precio</td><td>Existencia</td>
         </tr><tr>";
//obtenemos los datos resultado de la consulta 
    while ($row = mysql_fetch_row($result)){
	echo "<td>".$row[0]."</td><td>".$row[1]."</td>
              <td>".$row[2]."</td>";
    }
    echo "</tr></table>";
 }
?>  