<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbCamarasCorporales.class.php");
	require("../../objetos/camara.class.php");
	
	$unidad			= $_POST['codigoUnidad'];
	$fechaServicio	= $_POST['fechaServicio'];
	$tipoServicio	= $_POST['tipoServicio'];
	$correlativo	= $_POST['correlativo'];
	$horaInicio		= $_POST['horaInicio'];
	$horaTermino	= $_POST['horaTermino'];
	
	$fechaPaso		= explode("-",$fechaServicio);
	$fechaBuscar	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	if($horaInicio >= $horaTermino)	$horaTermino = "24:00";
	
	$objCamaras = new dbCamaras;
	$objCamaras->listaCamarasDisponibles($unidad, $fechaBuscar, $tipoServicio, $horaInicio, $horaTermino, $correlativo, &$camaras);
	$cantidad = count($camaras);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	for ($i=0; $i<$cantidad; $i++){
		echo "<camara>";
			echo "<codigo>".$camaras[$i]->getCodigo()."</codigo>";
			echo "<codigoEquipo>".$camaras[$i]->getCodEquipo()."</codigoEquipo>";
			echo "<descripcion>".$camaras[$i]->getModelo()."</descripcion>";
			echo "<numeroSerie>".$camaras[$i]->getNumeroSerie()."</numeroSerie>";
		echo "</camara>";
	}
	echo "</root>";
?>