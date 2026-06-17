<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/listaSolicitud.class.php");


  $unidad = $_POST['unidad'];
	$codigo	= $_POST['codigo'];
	//$unidad=1065;
	//echo $serieArma;
	
	//$codigoFuncionario = "969357J";
		
	$objFuncionarios = new dbRequerimiento;
	$objFuncionarios->datoMovimiento($unidad,$codigo,&$solicitudes);
	$cantidad = count($solicitudes);
  	
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>"; 
	   		for ($i=0; $i<$cantidad; $i++){
	   		 echo "<solicitud>";
   	 	   echo "<codigo>".$solicitudes->getCodigoSolicitud()."</codigo>";
	   		 echo "<unidad>".$solicitudes->getUnidad()."</unidad>";
	   		 //echo "<funcionario>".$solicitudes->getFuncionario()."</funcionario>";
   		   echo "<problema>".$solicitudes->getCodigoProblema()."</problema>";
   		   echo "<subproblema>".$solicitudes->getCodigoSubProblema()."</subproblema>";
   		   echo "<observacion>".$solicitudes->getObservacion()."</observacion>";
   		   echo "<tipoMovimiento>".$solicitudes->getCodigoTipoMov()."</tipoMovimiento>";
   		   //echo "<fecha>".$solicitudes->getFechaSolicitud()."</fecha";
   		   //echo "<estado>".$solicitudes->getEstado()."</estado>";
   		   echo "<usuario>".$solicitudes->getUsuarioSolicitud()."</usuario>";
   		   echo "<grado>".$solicitudes->getGrado()."</grado>";
   		   echo "<nombreCompleto>".$solicitudes->getNomCompleto()."</nombreCompleto>";
   		   echo "<text>".$solicitudes->getMovimientoTexto()."</text>";
   		   echo "<ide1>".$solicitudes->getIdentificador1()."</ide1>";
   		   echo "<ide2>".$solicitudes->getIdentificador2()."</ide2>";
         echo "</solicitud>";
         }
         echo "</root>";

?>