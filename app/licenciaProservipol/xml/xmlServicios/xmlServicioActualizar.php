<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/medioVigilancia.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/arma.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/tipoAccesorio.class.php");
		
	$codUnidad 				= $_POST['codigoUnidad'];
	$correlativo			= $_POST['correlativo'];
	$codTipoServicio		= $_POST['tipoServicio'];
	$codTipoExtraordinario	= $_POST['tipoServicioExtraordinario'];
	$descOtroExtraordinario	= $_POST['descServicioExtraordinario'];
	$fechaServicio 			= $_POST['fechaServicio'];   
	$horaInicio				= $_POST['horaInicio'];
	$horaTermino			= $_POST['horaTermino'];
	$descServicio			= $_POST['observaciones'];
  
	$listaMediosVigilancia	= unserialize(stripslashes($_POST['arrayListaMV']));
	$listaAccesorios		= unserialize(stripslashes($_POST['arrayListaAccesorios']));
	
	$arrayFecha	  			= explode("-",$fechaServicio);
	$fechaGuardar 			= $arrayFecha[2]."-".$arrayFecha[1]."-".$arrayFecha[0];
	
	if ($codTipoExtraordinario == 0) $codTipoExtraordinario = "Null";
	
	$tipoServicio = new tipoServicio;
	$tipoServicio->setCodigo($codTipoServicio);
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codUnidad);
	
	$tipoServicioExtraordinario = new tipoServicioExtraordinario;            
	$tipoServicioExtraordinario->setCodigo($codTipoExtraordinario);
	
	$servicio = new servicio;
	$servicio->setUnidad($unidad);
	$servicio->setCorrelativo($correlativo);
	$servicio->setTipoServicio($tipoServicio);
	$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
	$servicio->setDescripcionServicioOtroExtraordinario($descOtroExtraordinario);
	$servicio->setFecha($fechaGuardar);
	$servicio->setHoraInicio($horaInicio);
	$servicio->setHoraTermino($horaTermino);
	$servicio->setHoraInicio($horaInicio);
	$servicio->setObservaciones($descServicio);
	
	for ($i=0;$i<count($listaMediosVigilancia);$i++){
		$medioVigilanciaPaso = $listaMediosVigilancia[$i];
		$medioDeVigilancia = new medioVigilancia;
		$medioDeVigilancia->setVehiculo($medioVigilanciaPaso[0]);
		$medioDeVigilancia->setKmInicial($medioVigilanciaPaso[2]);
		$medioDeVigilancia->setKmFinal($medioVigilanciaPaso[3]);
		$medioDeVigilancia->setFactor($medioVigilanciaPaso[7]);
		
		$funcionariosAsignados = $medioVigilanciaPaso[4];
		
		for ($j=0;$j<count($funcionariosAsignados);$j++){
			
			$funcionario = new funcionario;                                      
			$funcionario->setCodigoFuncionario($funcionariosAsignados[$j]);      
			
			$k = 0;
			$salir = "NO";
			while($k<count($listaAccesorios)){
				$accesorioFuncionario = $listaAccesorios[$k];
			//	
			//	//echo $accesorioFuncionario[0] . " == " . $funcionariosAsignados[$j] ."\n";
			//	
				if ($accesorioFuncionario[0] == $funcionariosAsignados[$j]){
					$armasAsignadas = $accesorioFuncionario[2];
					//echo "cantidad " . count($armasAsignadas) . "\n";
					for ($l=0; $l<count($armasAsignadas); $l++){
						$arma = new arma;
						$arma->setCodigo($armasAsignadas[$l]);
						//$armas[$l] = $arma;
						$funcionario->setArmas($arma);      
					}
					$animalesAsignados = $accesorioFuncionario[3];
					for ($l=0; $l<count($animalesAsignados); $l++){
						$animal = new tipoAnimal;
						$animal->setCodigo($animalesAsignados[$l]);
						
						//$animales[$l] = $animal;
						$funcionario->setAnimales($animal);
					}
					$accesoriosAsignados	= $accesorioFuncionario[4];
					for ($l=0; $l<count($accesoriosAsignados); $l++){
						$accesorio = new tipoAccesorio;
						$accesorio->setCodigo($accesoriosAsignados[$l]);
						
						//$accesorios[$l] = $accesorio;
						$funcionario->setAccesorios($accesorio);    
            
					}
					$salir = "SI";
				}
				$k++;  
			}

			//$funcionario = new funcionario;
			//$funcionario->setCodigoFuncionario($funcionariosAsignados[$j]);
			//$funcionario->setArmas($armas);
			//$funcionario->setAnimales($animales);
			//$funcionario->setAccesorios($accesorios);
			
			//echo "GET dasdasdas armasAsignadas " . $armas[1]->getCodigo() . "\n";
			//echo "GET armasAsignadas 		   " . $funcionario->getArmas(0)->getCodigo() . "\n";
			
			$medioDeVigilancia->setFuncionarios($funcionario);
		}
		
		$cuadrantesAsignados = $medioVigilanciaPaso[5];
		for ($j=0;$j<count($cuadrantesAsignados);$j++){
			$cuadrante = new cuadrante;
			$cuadrante->setCodigo($cuadrantesAsignados[$j]);
			
			$medioDeVigilancia->setCuadrantes($cuadrante);
		}
		
        //Bucle agregado el 22-04-2015
        //Tiene por objetivo de obtener datos del arreglo de Destinos Asignados
		$unidadesAsignadas = $medioVigilanciaPaso[9];
		for ($j=0;$j<count($unidadesAsignadas);$j++){
			$unidades = new unidad;
			$unidades->setCodigoUnidad($unidadesAsignadas[$j]);
			
			$medioDeVigilancia->setUnidades($unidades);
		}
		//Fin Bucle
        
		$servicio->setMedioDeVigilancia($medioDeVigilancia);
		//echo "cantidad " . $servicio->getCantidadDeMediosDeVigilancia();
	}

	$objDBServicios = new dbServicios;
	$resultado = $objDBServicios->updateServicio($servicio);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
	
 ?>