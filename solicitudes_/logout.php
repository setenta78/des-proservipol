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
$fecha_hra_inicio           = $_SESSION['HORA_INICIO'];
$hra_termino                = date("Y/m/d H:i:s"); 
$codigoPerfil				        = $_SESSION['USUARIO_CODIGOPERFIL'];
$evento                     = "CIERRE DE SESION: EXITOSO";

//MODIFICA BITACORA USUARIOS

        $objDBUsuarios = new dbUsuarios;
        $objDBUsuarios->modificaBitacoraUsuario($codigoFuncionarioUsuario,$unidadUsuario,$fecha_hra_inicio,$hra_termino,$codigoPerfil,$evento);

//FIN

  session_start();
  session_unset();
  session_destroy();
  header("location: index.php");
?>