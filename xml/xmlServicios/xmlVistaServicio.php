<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/funcionario.class.php"); 
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");   
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/vehiculoAsignado.class.php");
	require("../../objetos/tipoArma.class.php");
	require("../../objetos/armaAsignada.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/animalAsignado.class.php");
	require("../../objetos/tipoAccesorio.class.php");
	require("../../objetos/accesorioAsignado.class.php");
	require("../../objetos/unidad.class.php");
	
		
	$unidad 		= $_POST['unidad'];
	$fecha 			= $_POST['fecha'];
	$codigoServicio	= $_POST['servicio'];
	
	//$unidad 		= "607510000000";
	//$fecha 			= "20080708";
	//$codigoServicio	= "1110";
	
	$fechaPaso 		= explode("-",$fecha);
   	$fechaServicio    = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$fecha = $fechaServicio;
  
   	$objServicios = new dbServicios;
   	$objServicios->buscaDatosServicio($unidad, $codigoServicio, $fecha, &$servicio);
	$objServicios->buscaFuncionariosAsignados($unidad, $codigoServicio, $fecha, &$funcionariosAsignados);
	$objServicios->buscaVehiculosAsignados($unidad, $codigoServicio, $fecha, &$vehiculosAsignados);
	$objServicios->buscaArmasAsignadas($unidad, $codigoServicio, $fecha, &$armasAsignadas);
  	$objServicios->buscaAnimalesAsignados($unidad, $codigoServicio, $fecha, &$animalesAsignados);
  	$objServicios->buscaAccesoriosAsignados($unidad, $codigoServicio, $fecha, &$accesoriosAsignados);
  	
  	
  	$fechaPaso 		= explode("-",$servicio->getFecha());
   	$fechaServicio    = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
  	
  	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
  	
  	echo "<datosServicio>";
	echo "<codigoServicio>".$servicio->getCodigoServicio()."</codigoServicio>";
  	echo "<nombreServicio>".$servicio->getNombre()."</nombreServicio>";
	echo "<fecha>".$fechaServicio."</fecha>";
	echo "<horaInicio>".$servicio->getHoraInicio()."</horaInicio>";
	echo "<horaTermino>".$servicio->getHoraTermino()."</horaTermino>";
	echo "<nombreUnidad>".$servicio->getUnidad()->getDescripcionUnidad()."</nombreUnidad>";
	echo "</datosServicio>";
   	
  	$cantidadFuncionarios = count($funcionariosAsignados); 
  	if ($cantidadFuncionarios > 0){
	  	echo "<funcionariosAsignados>";
	   	for ($i=0; $i<$cantidadFuncionarios; $i++){
	   		echo "<funcionario>";
	   		echo "<codigo>".$funcionariosAsignados[$i]->getCodigoFuncionario()."</codigo>";
	   		echo "<apellidoPaterno>".$funcionariosAsignados[$i]->getApellidoPaterno()."</apellidoPaterno>";
	   		echo "<apellidoMaterno>".$funcionariosAsignados[$i]->getApellidoMaterno()."</apellidoMaterno>";
	   		echo "<nombre>".$funcionariosAsignados[$i]->getPNombre()."</nombre>";
	   		echo "<grado>".$funcionariosAsignados[$i]->getGrado()->getDescripcion()."</grado>";    
	   		echo "</funcionario>";
	 	}
		echo "</funcionariosAsignados>";
	}
	
	$cantidadVehiculos = count($vehiculosAsignados); 
	if ($cantidadVehiculos>0){
		echo "<vehiculosAsignados>";
	   	for ($i=0; $i<$cantidadVehiculos; $i++){
	   		echo "<vehiculo>";
	   		echo "<codigo>".$vehiculosAsignados[$i]->getVehiculo()->getCodigoVehiculo()."</codigo>";
	   		echo "<tipo>".$vehiculosAsignados[$i]->getVehiculo()->getTipoVehiculo()->getDescripcion()."</tipo>";
	   		echo "<patente>".$vehiculosAsignados[$i]->getVehiculo()->getPatente()."</patente>";
	   		echo "<kmInicial>".$vehiculosAsignados[$i]->getKmInicial()."</kmInicial>";
	   		echo "<kmFinal>".$vehiculosAsignados[$i]->getKmFinal()."</kmFinal>";
	   		echo "<totalKms>".$vehiculosAsignados[$i]->getTotalKms()."</totalKms>";
	   		echo "<combustible>".$vehiculosAsignados[$i]->getLtsCombustible()."</combustible>";    
	   		echo "</vehiculo>";
	 	}
		echo "</vehiculosAsignados>";
	}
	
	$cantidadArmas = count($armasAsignadas); 
	if ($cantidadArmas>0){
		echo "<armasAsignadas>";
	   	for ($i=0; $i<$cantidadArmas; $i++){
	   		echo "<arma>";
	   		echo "<codigoTipo>".$armasAsignadas[$i]->getTipoArma()->getCodigo()."</codigoTipo>";
	   		echo "<tipo>".$armasAsignadas[$i]->getTipoArma()->getDescripcion()."</tipo>";
	   		echo "<numero>".$armasAsignadas[$i]->getNumero()."</numero>";
	   		//echo "<responsable>";
	   		echo "<codigoFuncionario>".$armasAsignadas[$i]->getResponsable()->getCodigoFuncionario()."</codigoFuncionario>";
	   		echo "<apellidoPaterno>".$armasAsignadas[$i]->getResponsable()->getApellidoPaterno()."</apellidoPaterno>";
	   		echo "<apellidoMaterno>".$armasAsignadas[$i]->getResponsable()->getApellidoMaterno()."</apellidoMaterno>";
	   		echo "<nombre>".$armasAsignadas[$i]->getResponsable()->getPNombre()."</nombre>";
	   		//echo "</responsable>";
	   		echo "</arma>";
	 	}
		echo "</armasAsignadas>";	
	}
	
  	$cantidadAnimales = count($animalesAsignados); 
  	if ($cantidadAnimales>0){
	  	echo "<animalesAsignados>";
	   	for ($i=0; $i<$cantidadAnimales; $i++){
	   		echo "<animal>";
	   		echo "<codigoTipo>".$animalesAsignados[$i]->getTipoAnimal()->getCodigo()."</codigoTipo>";
	   		echo "<tipo>".$animalesAsignados[$i]->getTipoAnimal()->getDescripcion()."</tipo>";
	   		echo "<cantidad>".$animalesAsignados[$i]->getCantidad()."</cantidad>";
	   		echo "</animal>";
	 	}
		echo "</animalesAsignados>";
	}

	$cantidadAccesorios = count($accesoriosAsignados); 	
	if ($cantidadAccesorios>0){
		echo "<accesoriosAsignados>";
	   	for ($i=0; $i<$cantidadAccesorios; $i++){
	   		echo "<accesorio>";
	   		echo "<codigoTipo>".$accesoriosAsignados[$i]->getTipoAccesorio()->getCodigo()."</codigoTipo>";
	   		echo "<tipo>".$accesoriosAsignados[$i]->getTipoAccesorio()->getDescripcion()."</tipo>";
	   		echo "<cantidad>".$accesoriosAsignados[$i]->getCantidad()."</cantidad>";
	   		echo "</accesorio>";
	 	}
		echo "</accesoriosAsignados>";
	}
	echo "</root>";
 ?>