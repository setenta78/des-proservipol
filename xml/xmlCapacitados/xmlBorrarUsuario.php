<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbUsuarios.class.php");
	
	$codFuncionario	= $_POST['codFuncionario'];
	
	$objDBUsuario = new dbUsuarios;
	$resultado = $objDBUsuario->eliminaUsuario($codFuncionario);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>