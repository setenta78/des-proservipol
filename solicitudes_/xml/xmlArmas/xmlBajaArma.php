<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbArmas.class.php");
	require("../../objetos/arma.class.php");
	require("../../objetos/estadoRecurso.class.php");
				
	$codigoArma		= $_POST['codigoArma'];
	$fechaActual    = date("Y-m-d"); 
	
	$estado = new estadoRecurso;
	$estado->setCodigo('100');
	$estado->setDescripcion("BAJA");
	
	$arma = new arma;
	$arma->setCodigo($codigoArma);
	$arma->setEstado($estado);
	
	$objDBArmas = new dbArmas;
	$resultado = $objDBArmas->updateEstadoArma($arma, $fechaActual);
	$resultado = $objDBArmas->bajaArma($arma, $motivo, $fechaActual);
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>