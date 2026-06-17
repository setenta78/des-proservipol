<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/solicitudRequerimiento.class.php");


	
	session_start();
  $codigoVehiculo			= $_POST['codigoVehiculo'];			
	
	$unidadUsuario		= $_POST['unidadUsuario'];
  $codigoUsuario		= $_POST['codigoUsuario'];
  $problema	        = $_POST['problema'];
  $subproblema  		= $_POST['subProblema'];
  $observ          	= $_POST['observ'];
  $fechaSolicitud   = $_POST['fechaSolicitud'];

   //$respuesta   	  	= strtoupper($_POST['observ']);
   $respuesta = $_POST['respuesta'];
  
  $codigo			= $_POST['codigo'];	
  $secciones		= 0;	
  
  //$identificador1 = $_POST['idUnidad'];	
  //$identificador2 = $_POST['idFecha'];	
  
  $opcionServicio   = $_POST['opcionServicio'];
   if($opcionServicio!=""){
  $identificador1 = $_POST['opcionServicio'];	
  $identificador2 = $_POST['idFecha2'];	
  $tipoMovimiento = 10;
  }else{
  $identificador1 = $_POST['idUnidad'];	
  $identificador2 = $_POST['idFecha'];	
}
  
  //IDENTIFICADOR1
 if($idUnidad!="" and  $idFecha!=""){ 	
 	$identificador1=$idUnidad;
  $identificador2= $idFecha;
  $etiqueta1="ETIQUETA1";
  $etiqueta2="ETIQUETA2";
  $tipoMovimiento=10;
}elseif($idUnidad!=""){
	$identificador1=$idUnidad;
  $identificador2= "NULL";
  $etiqueta1="ETIQUETA1";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idFecha!="")	{
	$identificador1="NULL";
  $identificador2=$idFecha;
  $etiqueta1="NULL";
  $etiqueta2="ETIQUETA2";
  $tipoMovimiento=10;
}
  
if($identificador1==""){ 
$identificador1="NULL";
$tipoMovimiento=10;
}

if($identificador2==""){ 
$identificador2="NULL";
$tipoMovimiento=10;
}
  

if($etiqueta1=="") $etiqueta1="NULL";
if($etiqueta2=="") $etiqueta2="NULL";
  

  $fecha2 = date("d-m-Y");
  

  
  $fechaPaso 		= explode("-",$fechaSolicitud);
  $fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
    	
	$vehiculo= new requerimiento;
	$vehiculo->setCodigoSolicitud($codigo);
  $vehiculo->setUnidad($unidadUsuario);
  $vehiculo->setFuncionario($codigoUsuario);
  $vehiculo->setProblema($problema);
  $vehiculo->setSubProblema($subproblema);
  $vehiculo->setFechaSolicitud($fechaIngresar);
  $vehiculo->setObservacion($observ);
  $vehiculo->setIdentificador1($identificador1);
	$vehiculo->setIdentificador2($identificador2);
	$vehiculo->setEtiqueta1($etiqueta1);
	$vehiculo->setEtiqueta2($etiqueta2);
	$vehiculo->setTipoMovimiento($tipoMovimiento);
	$vehiculo->setFechaMovimiento($fecha2);
	$vehiculo->setTextoMovimiento($observ);
	$vehiculo->setSecciones($secciones);
	
	
 
  
	$objDBVehiculos= new dbRequerimiento;
	$idNuevo = $objDBVehiculos->nuevoDioscar($vehiculo);

	
	$vehiculo->setCodigoSolicitud($idNuevo);	
	
	if ($fecha2 != ""){
		$fechaPaso 		= explode("-",$fecha2);
   	$fechaIngresar2  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBVehiculos->insertMovimiento($vehiculo, $fechaIngresar2);
	 }
					
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>