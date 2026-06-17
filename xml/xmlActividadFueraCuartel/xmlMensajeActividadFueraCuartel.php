<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbActividadFueraCuartel.class.php");
	require("../../objetos/actividadFueraCuartel.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/escalafon.class.php");
	
	$unidad	= $_POST['unidad'];
	$fecha 		= date("Ymd");
	
	$objServicios = new dbActividadFueraCuartel;
	$objServicios->mensajeActividadFueraCuartel($unidad, $fecha,&$servicios);
	$cantidad = count($servicios);
	if ($servicios != ""){		
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
            echo "<servicio>";
            echo "<codigo>".$servicios[$i]->getCodigoFuncionario()."</codigo>";
            echo "<apellido1>".$servicios[$i]->getApellidoPaterno()."</apellido1>";
            echo "<apellido2>".$servicios[$i]->getApellidoMaterno()."</apellido2>";
            echo "<nombre>".$servicios[$i]->getPNombre()."</nombre>";
            echo "<nombre2>".$servicios[$i]->getSNombre()."</nombre2>";
            echo "<tipoActividad>".$servicios[$i]->getActividadFueraCuartel()->getTipoActividad()."</tipoActividad>";
            echo "<grado>".$servicios[$i]->getGrado()->getDescripcion()."</grado>";
            echo "<estado>".$servicios[$i]->getActividadFueraCuartel()->getEstado()."</estado>";
            echo "</servicio>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
	
 ?>