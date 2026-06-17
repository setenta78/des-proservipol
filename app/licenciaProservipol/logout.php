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
$unidadUsuario			      	= 20;
$fecha_hra_inicio           = $_SESSION['HORA_INICIO'];
$hra_termino                = date("Y/m/d H:i:s"); 
$codigoPerfil				        = 90;
$evento                     = "CIERRE DE SESION: EXITOSO";

$codigoUnidadUsuario        =  $_SESSION['USUARIO_PROSERVIPOLUNIDAD'];
$perfil1= $_SESSION['USUARIO_PROSERVIPOLPERFIL'];

//echo $fecha_hra_inicio;
//MODIFICA BITACORA USUARIOS

        $objDBUsuarios = new dbUsuarios;
        $objDBUsuarios->modificaBitacoraUsuario($codigoFuncionarioUsuario,$codigoUnidadUsuario,$fecha_hra_inicio,$hra_termino,$perfil1,$evento);

//FIN

  session_start();
  session_unset();
  session_destroy();
  header("location: index.php");
?>