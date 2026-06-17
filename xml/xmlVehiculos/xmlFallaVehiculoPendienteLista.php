<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFallaVehiculo.class.php");
	require("../../objetos/vehiculo.class.php");
	
	session_start();
	$codigoUnidad		= $_SESSION['USUARIO_CODIGOUNIDAD'];
	
	/*---Indicar los dias de plazo para ingresar las fallas desde el momento en que se postergo. Por defecto 3 dias despues de la fecha de postergación----------------------------------------------*/
	$dias = 3;
	/*-------------------------------------------------*/
		
	$objFallas = new dbFallaVehiculo;
	$objFallas->FallaVehiculoLista($codigoUnidad, $dias, &$fallas);
	$cantidad = count($fallas);
	
	if($cantidad > 0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		for($i=0;$cantidad > $i;$i++){
			echo "<falla>";
				echo "<patente>".$fallas[$i]->getPatente()."</patente>";
				echo "<tipo>".$fallas[$i]->getTipoVehiculo()."</tipo>";
				echo "<modelo>".$fallas[$i]->getModeloVehiculo()."</modelo>";
			echo "</falla>";
		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>