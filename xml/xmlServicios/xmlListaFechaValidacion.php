<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../objetos/servicio.class.php");
	require("../../baseDatos/dbServicios.class.php");
	
	$unidad         = $_POST['unidad'];
	$fechaServicios = $_POST['fechaServicios'];
	
	$fechaPaso      = explode("-",$fechaServicios);
    $fechaServicios = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objServicios = new dbServicios;
	$objServicios->buscaListaFechaValidacion($unidad, $fechaServicios, &$fechaValidados);

	$cantidad = count($fechaValidados);
	if ($fechaValidados != ""){		
        echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
        echo "<root>";
        for ($i=0; $i<$cantidad; $i++){
            $fechaPaso 		= explode("-",$fechaValidados[$i]->getFecha());
            $fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
            
            echo "<servicio>";
                echo "<fecha>".$fechaMostrar."</fecha>";
            echo "</servicio>";
        }
        echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>