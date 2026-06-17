<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbUsuarios.class.php");
	require("../../objetos/usuario.class.php");
	
	$codigoUsuario  = $_POST['codigoUsuario'];		
	
	$objDBUsuarios = new dbUsuarios;
	$resultado = $objDBUsuarios->obtieneClaveUsuario($codigoUsuario, &$claveActual);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<usuario>";
   	echo "<claveUsuario>".$claveActual."</claveUsuario>";
   	echo "</usuario>";

 ?>