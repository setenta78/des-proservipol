<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
		
	$unidadServicio	= $_POST['unidadServicio'];
	$fecha1 		= $_POST['fecha1'];
	$fecha2			= $_POST['fecha2'];
	
	//$funcionario = "974915P";
	//$fecha1 	 = "01-03-2011";
	//$fecha2 	 = "18-03-2011";
		
	$fechaPaso 		= explode("-",$fecha1);
   	$fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
   	$fechaPaso 		= explode("-",$fecha2);
   	$fechaBuscar2   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objServicios = new dbServicios;
	$objServicios->buscaColacionPorFuncionario($unidadServicio, $fechaBuscar1, $fechaBuscar2, 
	&$codigoFuncionario,  &$cantidadColaciones, &$codigoServicio);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<funcionarios>";
	$cantidadRegistros = count($codigoFuncionario);
	for ($i=0; $i < $cantidadRegistros; $i++){
		echo "<funcionario>";
		echo "<codigoFuncionario>".$codigoFuncionario[$i]."</codigoFuncionario>";
		echo "<cantidadColaciones>".$cantidadColaciones[$i]."</cantidadColaciones>";  
		echo "<codigoServicio>".$codigoServicio[$i]."</codigoServicio>";
		echo "</funcionario>";
	}
	echo "</funcionarios>";
	echo "</root>";
 ?>