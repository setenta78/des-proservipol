<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbFerper.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	require("../../objetos/ferper.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/escalafon.class.php");
		
	$unidad	= $_POST['unidad'];
	$fecha 		= date("Ymd");
	
	$objServicios = new dbFerper;
	$objServicios->mensajePermiso($unidad, $fecha,&$servicios);
	$cantidad = count($servicios);
	if ($servicios != ""){		
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   	echo "<servicio>";
	   	echo "<codigo>".$servicios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<apellidoPaterno>".$servicios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   		echo "<apellidoMaterno>".$servicios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   		echo "<nombre>".$servicios[$i]->getPNombre()."</nombre>";
   		echo "<nombre2>".$servicios[$i]->getSNombre()."</nombre2>";
   		echo "<permiso>".$servicios[$i]->getDescripcionLicencia()."</permiso>";
   		echo "<grado>".$servicios[$i]->getGrado()->getDescripcion()."</grado>";
   		echo "<estado>".$servicios[$i]->getTipoPermiso()."</estado>";
	   	echo "</servicio>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
	
 ?>