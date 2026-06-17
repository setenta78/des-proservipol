<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFallaVehiculo.class.php");
	require("../../objetos/fallaPospuesta.class.php");
	
	session_start();
	$codigoUnidad		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoVehiculo		= $_POST['codigoVehiculo'];
	
	/*---Indicar los dias de plazo para ingresar las fallas desde el momento en que se postergo. Por defecto 3 dias despues de la fecha de postergaci�n----------------------------------------------*/
	$dias = 3;
	/*-------------------------------------------------*/
		
	$objFallas = new dbFallaVehiculo;
	$objFallas->FallaVehiculoPendiente($codVehiculo,$codigoUnidad, $dias, &$fallas);
	$cantidad = count($fallas);
	
	if($cantidad > 0){
		for($i=0;$cantidad > $i;$i++){
			echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
			echo "<root>";
				echo "<falla>";
					echo "<codigo>".$fallas[$i]->getCodigo_Vehiculo()."</codigo>";
					echo "<correlativo>".$fallas[$i]->getCorrelativo_Estado()."</correlativo>";
					echo "<fecha>".$fallas[$i]->getFecha_Desde()."</fecha>";
				echo "</falla>";
			echo "</root>";
		}
	} else {
		echo "VACIO";
	}
?>