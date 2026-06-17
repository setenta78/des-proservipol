<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSim.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/estadoRecurso.class.php");


		
	$codigo = $_POST['codigo'];
	$serieArma	= strtoupper($_POST['serieSimccar']);
	//echo $serieArma;
	
	//$codigoFuncionario = "969357J";
		
	$objFuncionarios = new dbDioscar;
	$objFuncionarios->buscaDioscar($codigo,$serieArma,&$dioscars);
	$cantidad = count($dioscars);
  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>"; 

	   		 $fechaPaso 		= explode("-",$dioscars->getEstadoVehiculo()->getFechaDesde());
	       $fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		
	   		 echo "<dioscar>";
	       echo "<unidad>".$dioscars->getUnidad()->getCodigoUnidad()."</unidad>";
	       echo "<descUnidad>".$dioscars->getUnidad()->getDescripcionUnidad()."</descUnidad>";
         echo "<codigo>".$dioscars->getCodigoSimccar()."</codigo>";
	   		 echo "<serie>".$dioscars->getserieSimccar()."</serie>";
	   		 echo "<tarjeta>".$dioscars->getTarjetaSimccar()."</tarjeta>";
         echo "<imei>".$dioscars->getImei()."</imei>";
         echo "<estado>".$dioscars->getEstadoVehiculo()->getCodigo()."</estado>";
         echo "<codigoUnidadAgregado>".$dioscars->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
   	     echo "<desUnidadAgregado>".$dioscars->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
   	 	   echo "<fechaEstado>".$fechaMostrar."</fechaEstado>";
   	 	   echo "<origen>".$dioscars->getOrigen()."</origen>";
   	 	   echo "<verifica>".$dioscars->getVerifica()."</verifica>";
   	 	   echo "<marca>".$dioscars->getMarca()."</marca>";
   	 	   echo "<modelo>".$dioscars->getModelo()."</modelo>";
   	 	   echo "<anno>".$dioscars->getAnno()."</anno>";
         echo "</dioscar>";
         echo "</root>";
	}else{
		     echo "VACIO";
	}
 ?>