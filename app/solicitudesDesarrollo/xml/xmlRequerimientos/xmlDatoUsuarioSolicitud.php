<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/datoUsuarioSolicitud.class.php");

  $unidad = $_POST['unidad'];
	$usuario	= strtoupper($_POST['usuario']);
	$solicitud = $_POST['solicitud'];
	//echo $serieArma;
	
	//$codigoFuncionario = "969357J";
		
	$objFuncionarios = new dbRequerimiento;
	$objFuncionarios->datoUsuarioSolicitud($unidad,$solicitud,$usuario,&$vistas);
	$cantidad = count($vistas);
  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>"; 
	   		
	   		 echo "<dato>";
	   		 echo "<unidad>".$vistas->getCodigoUnidad()."</unidad>";
   	 	   echo "<zona>".$vistas->getZona()."</zona>";
   	 	   echo "<prefectura>".$vistas->getPrefectura()."</prefectura>";
   	 	   echo "<comisaria>".$vistas->getComisaria()."</comisaria>";
   	 	   echo "<destacamento>".$vistas->getDestacamento()."</destacamento>";
   	 	   echo "<funcionario>".$vistas->getFuncionario()."</funcionario>";
   	 	   echo "<nombre>".$vistas->getNomFuncionario()."</nombre>";
   	 	   echo "<tipo>".$vistas->getTipoUsuario()."</tipo>";
   	 	   echo "<grado>".$vistas->getGrado()."</grado>";
   	 	   echo "<problema>".$vistas->getCodigoProblema()."</problema>";
   		   echo "<subproblema>".$vistas->getCodigoSubProblema()."</subproblema>";
   		   echo "<obs>".$vistas->getObservacion()."</obs>";
   		   //echo "<tipoMovimiento>".$solicitudes->getCodigoTipoMov()."</tipoMovimiento>";
   		   echo "<ide1>".$vistas->getIdentificador1()."</ide1>";
   		   echo "<ide2>".$vistas->getIdentificador2()."</ide2>";
   		   echo "<text>".$vistas->getMovimientoTexto()."</text>";
   		   echo "<mov>".$vistas->getCodigoTipoMov()."</mov>";
         echo "</dato>";
         echo "</root>";
	}else{
		     echo "VACIO";
	}
?>