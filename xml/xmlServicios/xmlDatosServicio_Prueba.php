<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/medioVigilancia.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/tipoAccesorio.class.php");
	require("../../objetos/tipoArma.class.php");
	require("../../objetos/arma.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/fechaHora.class.php");
	require("../../objetos/factor.class.php");
		
	$unidad 	 = $_POST['codigoUnidad'];
	$correlativo = $_POST['correlativo'];
	
	$unidad 	 = 555;
	$correlativo = 18627;
		
	$objServicios = new dbServicios;
	$objServicios->buscaDatosServicio($unidad, $correlativo, &$servicio);
	//$objServicios->buscaFuncionariosAsignados($unidad, $correlativo, &$funcionarios);
	$objServicios->buscaMedioVigilancia($unidad, $correlativo, &$mediosVigilancia);
	//echo "holaaaaaa";	
	$objServicios->buscaCuadrantesAsignados($unidad, $correlativo, &$mediosVigilancia);
	
	$objServicios->buscaAccesoriosAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaArmasAsignadas($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaAnimalesAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaHojaDeRuta($unidad, $correlativo, &$tieneHojaRuta);	
	

	
	
	$cantidadFuncionarios = count($funcionarios);
	$cantidadMediosVigilancia = count($mediosVigilancia);
	//echo "cantidadMediosVigilancia " . $cantidadMediosVigilancia;
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	
   		$fechaPaso 		= explode("-",$servicio->getFecha());
   		$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   		
   		$objFecha = new fechaHora;
   		$fechaCompleta = $objFecha->formatoFechaCompleta($servicio->getFecha());
   		
   		echo "<servicio>";
   		echo "<identificacionServicio>";
   		echo "<codUnidad>".$servicio->getUnidad()->getCodigoUnidad()."</codUnidad>";
   		echo "<desUnidad>".$servicio->getUnidad()->getDescripcionUnidad()."</desUnidad>";
   		echo "<fecha>".$fechaMostrar."</fecha>";
   		echo "<fechaCompleta>".$fechaCompleta."</fechaCompleta>";
   		echo "<codServicio>".$servicio->getTipoServicio()->getCodigo()."</codServicio>";
   		echo "<desServicio>".$servicio->getTipoServicio()->getDescripcion()."</desServicio>";
   		echo "<tipoServicio>".$servicio->getTipoServicio()->getTipo()."</tipoServicio>";
   		echo "<codServicioExtraordinario>".$servicio->getServicioExtraordinario()->getCodigo()."</codServicioExtraordinario>";
   		echo "<desServicioExtraordinario>".$servicio->getServicioExtraordinario()->getDescripcion()."</desServicioExtraordinario>";
   		echo "<desOtroServicioExtraordinario>".$servicio->getDescripcionServicioOtroExtraordinario()."</desOtroServicioExtraordinario>";
   		echo "<horaInicio>".$servicio->getHoraInicio()."</horaInicio>";
   		echo "<horaTermino>".$servicio->getHoraTermino()."</horaTermino>";
   		echo "<observaciones>".$servicio->getObservaciones()."</observaciones>";
   		echo "<existeHojaRuta>".$tieneHojaRuta."</existeHojaRuta>";
   		echo "</identificacionServicio>";
   		
   		if ($mediosVigilancia != ""){	
	   		echo "<mediosDeVigilancia>";
	   		
	   		for ($i=0; $i<$cantidadMediosVigilancia; $i++){
	   			
	   			if ($mediosVigilancia[$i]->getVehiculo()->getCodigoVehiculo() == "") {
	   				$codigoVehiculo 	= 0;
	   				$patenteVehiculo 	= "INFANTERIA";
	   				$tipoVehiculo 		= "SIN VEHICULO";
	   			} else {
	   				$codigoVehiculo 	= $mediosVigilancia[$i]->getVehiculo()->getCodigoVehiculo();
	   				$patenteVehiculo 	= $mediosVigilancia[$i]->getVehiculo()->getPatente();
	   				$tipoVehiculo 		= $mediosVigilancia[$i]->getVehiculo()->getTipoVehiculo()->getDescripcion();
	   			}
	   			
	   			echo "<medioVigilancia>";
	   			echo "<numeroMedio>".$mediosVigilancia[$i]->getNumeroMedio()."</numeroMedio>";
	   			echo "<codigoFactor>".$mediosVigilancia[$i]->getFactor()->getCodigo()."</codigoFactor>";
	   			echo "<descripcionFactor>".$mediosVigilancia[$i]->getFactor()->getDescripcion()."</descripcionFactor>";
	   			echo "<vehiculo>";
	   			echo "<codigoVehiculo>".$codigoVehiculo."</codigoVehiculo>";
	   			echo "<patenteVehiculo>".$patenteVehiculo."</patenteVehiculo>";
	   			echo "<tipoVehiculo>".$tipoVehiculo."</tipoVehiculo>";
	   			echo "<kmInicial>".$mediosVigilancia[$i]->getKmInicial()."</kmInicial>";
	   			echo "<kmFinal>".$mediosVigilancia[$i]->getKmFinal()."</kmFinal>";
	   			echo "</vehiculo>";
	   			echo "<funcionarios>";
		   		for ($j=0; $j<$mediosVigilancia[$i]->getCantidadDeFuncionarios(); $j++){
		   			echo "<funcionario>";
		   			echo "<identificacionFuncionario>";
		   			echo "<codigoFuncionario>".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario()."</codigoFuncionario>";
		   			echo "<apellidoPaterno>".$mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno()."</apellidoPaterno>";
	   				echo "<apellidoMaterno>".$mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno()."</apellidoMaterno>";
	   				echo "<primerNombre>".$mediosVigilancia[$i]->getFuncionarios($j)->getPNombre()."</primerNombre>";
	   				echo "<grado>".$mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion()."</grado>";
	   				echo "</identificacionFuncionario>";
	   				
	   				echo "<accesorios>";
	   				for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadAccesorios(); $k++){
			   			echo "<accesorio>";
			   			echo "<codigoAccesorio>".$mediosVigilancia[$i]->getFuncionarios($j)->getAccesorios($k)->getCodigo()."</codigoAccesorio>";
			   			echo "<descripcionAccesorio>".$mediosVigilancia[$i]->getFuncionarios($j)->getAccesorios($k)->getDescripcion()."</descripcionAccesorio>";
		   				echo "</accesorio>";	
		   			}
		   			echo "</accesorios>";
		   			
		   			echo "<armas>";
		   			for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadArmas(); $k++){
			   			echo "<arma>";
			   			echo "<codigoArma>".$mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getCodigo()."</codigoArma>";
			   			echo "<tipoArma>".$mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getTipo()->getDescripcion()."</tipoArma>";
			   			echo "<numeroSerie>".$mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getNumeroSerie()."</numeroSerie>";
		   				echo "</arma>";	
		   			}
		   			echo "</armas>";
		   			
		   			echo "<animales>";
		   			for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadAnimales(); $k++){
			   			echo "<animal>";
			   			echo "<codigoAnimal>".$mediosVigilancia[$i]->getFuncionarios($j)->getAnimales($k)->getCodigo()."</codigoAnimal>";
			   			echo "<descripcionAnimal>".$mediosVigilancia[$i]->getFuncionarios($j)->getAnimales($k)->getDescripcion()."</descripcionAnimal>";
		   				echo "</animal>";	
		   			}
	   				echo "</animales>";
		   			echo "</funcionario>";
		   			
		   		}
		   		echo "</funcionarios>";
		   		echo "<cuadrantes>";
		   		for ($j=0; $j<$mediosVigilancia[$i]->getCantidadDeCuadrantes(); $j++){
		   			echo "<cuadrante>";
		   			echo "<codigoCuadrante>".$mediosVigilancia[$i]->getCuadrantes($j)->getCodigo()."</codigoCuadrante>";
		   			echo "<descripcionCuadrante>".$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion()."</descripcionCuadrante>";
	   				echo "</cuadrante>";
		   		}
		   		echo "</cuadrantes>";
	   			echo "</medioVigilancia>";
	   		}
	   		echo "</mediosDeVigilancia>";
	   	}
   		echo "</servicio>";
 	echo "</root>";
 ?>