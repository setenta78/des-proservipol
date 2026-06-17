<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbUsuarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/perfil.class.php");
	
	session_start();
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$codFuncionario	= $_POST['codFuncionario'];
	$codPerfil		= $_POST['codPerfil'];
	
	$perfil = new perfil;
	$perfil->setCodigoPerfil($codPerfil);
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	
	$funcionario = new funcionario;
	$funcionario->setCodigoFuncionario($codFuncionario);
	$funcionario->setPerfil($perfil);
	$funcionario->setUnidad($unidad);
	
	$objDBUsuario = new dbUsuarios;
	$resultado = $objDBUsuario->CrearUsuario($funcionario);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>