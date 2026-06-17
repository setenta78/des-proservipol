<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	
	$unidadServicio	= $_POST['unidadServicio'];
	$fecha1 		= $_POST['fecha1'];
	$fecha2			= $_POST['fecha2'];
	$servicio		= $_POST['tipoServicio'];
	
	//$funcionario = "974915P";
	//$fecha1 	 = "01-03-2011";
	//$fecha2 	 = "18-03-2011";
		
	$fechaPaso 		= explode("-",$fecha1);
	$fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$fechaPaso 		= explode("-",$fecha2);
	$fechaBuscar2   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objServicios = new dbServicios;
	$objServicios->buscaServiciosPorFuncionario($unidadServicio, $fechaBuscar1, $fechaBuscar2, $servicio, &$codigoFuncionario, &$cantidadColaciones);
	$cantidad = count($codigoFuncionario);
	//echo $cantidad;
	if ($cantidad > 0){
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		
			echo "<funcionarios>";
			echo "<codigoFuncionario>".$codigoFuncionario[$i]."</codigoFuncionario>";
			echo "<cantidadColaciones>".$cantidadColaciones[$i]."</cantidadColaciones>";
			echo "</funcionarios>";
			
 		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
	
?>