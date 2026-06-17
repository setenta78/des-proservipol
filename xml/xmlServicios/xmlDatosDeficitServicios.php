<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/funcionario.class.php");
		
	$unidad = $_POST['codigoUnidad'];
	$fecha	= $_POST['fecha'];
	
	$arrayFecha	= explode("-",$fecha);
	$fecha	 		= $arrayFecha[2]."-".$arrayFecha[1]."-".$arrayFecha[0];
	
	$objServicios = new dbServicios;
	$objServicios->DeficitServicios($unidad, $fecha, &$funcionarios);
	
	$cantidadFuncionarios = count($funcionarios);
	if($funcionarios){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  echo "<root>";
		for ($i=0; $i < $cantidadFuncionarios; $i++){
			echo "<funcionario>";
		  	echo "<codigoFuncionario>".$funcionarios[$i]->getCodigoFuncionario()."</codigoFuncionario>";
		  	echo "<nombreFuncionario>".$funcionarios[$i]->getPNombre()."</nombreFuncionario>";
		  echo "</funcionario>";
		}
	 	echo "</root>";
 	} else {
		echo "VACIO";
	}
?>