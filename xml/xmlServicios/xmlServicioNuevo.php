<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
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
	require("../../objetos/animal.class.php");
	require("../../objetos/camara.class.php");
	
	$codUnidad 				= $_POST['codigoUnidad'];
	$codTipoServicio		= $_POST['tipoServicio'];
	$codTipoExtraordinario	= $_POST['tipoServicioExtraordinario'];
	$descOtroExtraordinario	= utf8_decode($_POST['descServicioExtraordinario']);
	$fechaServicio 			= $_POST['fechaServicio'];
	$horaInicio				= $_POST['horaInicio'];
	$horaTermino			= $_POST['horaTermino'];
	$descServicio			= utf8_decode($_POST['observaciones']);
	$codigoUnidadDestino	= $_POST['codigoUnidadDestino'];
	
	$listaMediosVigilancia	= unserialize(stripslashes($_POST['arrayListaMV']));
	$listaAccesorios		= unserialize(stripslashes($_POST['arrayListaAccesorios']));
	
	$arrayFecha	  			= explode("-",$fechaServicio);
	$fechaGuardar 			= $arrayFecha[2]."-".$arrayFecha[1]."-".$arrayFecha[0];
	
	if ($codTipoExtraordinario == 0) $codTipoExtraordinario = "Null";
	if ($codigoUnidadDestino == 0) $codigoUnidadDestino = "Null";
	
	$tipoServicio = new tipoServicio;
	$tipoServicio->setCodigo($codTipoServicio);
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codUnidad);
	
	$destino = new unidad;
	$destino->setCodigoUnidad($codigoUnidadDestino);
	
	$tipoServicioExtraordinario = new tipoServicioExtraordinario;            
	$tipoServicioExtraordinario->setCodigo($codTipoExtraordinario);
	
	$servicio = new servicio;
	$servicio->setUnidad($unidad);
	$servicio->setTipoServicio($tipoServicio);
	$servicio->setServicioExtraordinario($tipoServicioExtraordinario);
	$servicio->setDescripcionServicioOtroExtraordinario($descOtroExtraordinario);
	$servicio->setFecha($fechaGuardar);
	$servicio->setHoraInicio($horaInicio);
	$servicio->setHoraTermino($horaTermino);
	$servicio->setHoraInicio($horaInicio);
	$servicio->setObservaciones($descServicio);
	$servicio->setDestino($destino);
	
	for ($i=0;$i<count($listaMediosVigilancia);$i++){
		$medioVigilanciaPaso = $listaMediosVigilancia[$i];
		$medioDeVigilancia = new medioVigilancia;
		$medioDeVigilancia->setVehiculo($medioVigilanciaPaso[0]);
		$medioDeVigilancia->setKmInicial($medioVigilanciaPaso[2]);
		$medioDeVigilancia->setKmFinal($medioVigilanciaPaso[3]);
		$medioDeVigilancia->setFactor($medioVigilanciaPaso[7]);
		
		$funcionariosAsignados = $medioVigilanciaPaso[4];
		
		$medioDeVigilancia->setAnimal($medioVigilanciaPaso[9]);
		
		for ($j=0;$j<count($funcionariosAsignados);$j++){
			$funcionario = new funcionario;                                      
			$funcionario->setCodigoFuncionario($funcionariosAsignados[$j]);      
			$k = 0;
			$salir = "NO";
			while($k<count($listaAccesorios)){
				$accesorioFuncionario = $listaAccesorios[$k];
				if ($accesorioFuncionario[0] == $funcionariosAsignados[$j]){

					$armasAsignadas = $accesorioFuncionario[2];
					for ($l=0; $l<count($armasAsignadas); $l++){
						$arma = new arma;
						$arma->setCodigo($armasAsignadas[$l]);
						$funcionario->setArmas($arma);      
					}
					
					$animalesAsignados = $accesorioFuncionario[3];
					for ($l=0; $l<count($animalesAsignados); $l++){
						$animal = new tipoAnimal;
						$animal->setCodigo($animalesAsignados[$l]);
						$funcionario->setAnimales($animal);
					}
					
					$accesoriosAsignados = $accesorioFuncionario[4];
					for ($l=0; $l<count($accesoriosAsignados); $l++){
						$accesorio = new tipoAccesorio;
						$accesorio->setCodigo($accesoriosAsignados[$l]);
						$funcionario->setAccesorios($accesorio);
					}

					$camarasAsignadas = $accesorioFuncionario[8];
					for ($l=0; $l<count($camarasAsignadas); $l++){
						$camara = new camara;
						$camara->setCodigo($camarasAsignadas[$l]);
						$funcionario->setCamaras($camara);
					}

					$salir = "SI";
				}
				$k++;  
			}
			$medioDeVigilancia->setFuncionarios($funcionario);
		}
		
		$cuadrantesAsignados = $medioVigilanciaPaso[5];
		for ($j=0;$j<count($cuadrantesAsignados);$j++){
			$cuadrante = new cuadrante;
			$cuadrante->setCodigo($cuadrantesAsignados[$j]);
			
			$medioDeVigilancia->setCuadrantes($cuadrante);
		}
		
		$unidadesAsignadas = $medioVigilanciaPaso[12];
		for ($j=0;$j<count($unidadesAsignadas);$j++){
			$unidades = new unidad;
			$unidades->setCodigoUnidad($unidadesAsignadas[$j]);
				
			$medioDeVigilancia->setUnidades($unidades);
		}
		
		$servicio->setMedioDeVigilancia($medioDeVigilancia);
	}
	
	$objDBServicios = new dbServicios;
	$resultado = $objDBServicios->insertNuevoServicio($servicio, &$correlativo);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>