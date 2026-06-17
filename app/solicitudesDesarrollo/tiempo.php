<?php 
  include("session.php");
  
	include("./inc/configV3.inc.php");
	include("./baseDatos/Conexion.class.php");      
	require("./baseDatos/dbUsuarios.class.php");
	require("./objetos/usuario.class.php");
	require("./objetos/perfil.class.php");
	require("./objetos/funcionario.class.php");
	require("./objetos/unidad.class.php");

$codigoFuncionarioUsuario 	= $_SESSION['USUARIO_CODIGOFUNCIONARIO']; 
$unidadUsuario			      	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$fecha_hra_inicio              = $_SESSION['HORA_INICIO'];
$hora_actual                = date("Y/m/d H:i:s"); 
$codigoPerfil				        = $_SESSION['USUARIO_CODIGOPERFIL'];

$tiempo_transcurrido = ceil((strtotime($hora_actual)-strtotime($fecha_hra_inicio))); //Calculamos el tiempo transcurrido 

$evento                     = "CIERRE DE SESION: INACTIVIDAD";



//Comparamos el tiempo transcurrido, si pasaron 10 minutos o más  
if($tiempo_transcurrido >= 5000) { 

 //MODIFICA BITACORA USUARIOS
  $objDBUsuarios = new dbUsuarios;
  $objDBUsuarios->modificaBitacoraUsuario($codigoFuncionarioUsuario,$unidadUsuario,$fecha_hra_inicio,$hora_actual,$codigoPerfil,$evento);
//FIN

  session_start();
  session_unset();
  session_destroy(); // destruyo la sesión 
  echo'<script type="text/javascript">alert("SU SESION HA EXPIRADO POR INACTIVIDAD'; 
  echo', PARA CONTNUAR DEBE INICIAR SESION NUEVAMENTE.");window.location.href="index.php";</script>';     
}else { 
 //Sino, actualizo la fecha y hora de la sesión 
  $_SESSION['HORA_INICIO'] = $fecha_hra_inicio; 
 } 
   
?>