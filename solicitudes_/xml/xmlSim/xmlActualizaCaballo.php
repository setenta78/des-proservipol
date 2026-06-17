<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbSim.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoAnimal.class.php"); 


$codigo		= $_POST['codigo'];
		
	//echo $codigoVehiculo;

	//$codigo 	= $_POST['codigo'];
	
	$codigoEstado	  		= $_POST['estado'];
  $fechaNuevoEstado	  	= $_POST['fechaNuevoEstado'];

	$numeroBCU				= $_POST['numeroBCU'];
	
	$codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
	
  $verificar     = $_POST['verificar'];  
	$verificaOculto = $_POST['verificaOculto'];  
	$origen        = $_POST['origen'];  
	
	$reemplazo       = $_POST['reemplazo'];  
	
	$tarjeta=$_POST['tarjeta'];  
	$imei=$_POST['imei'];  
	$marca=$_POST['marca'];  
	$modelo=$_POST['modelo'];  
	$anno=$_POST['anno'];  
	//$marca="wwwww";
	//$codigoUnidad			= "610040000000";
	session_start();                                                 
  $codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];   	 
    
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
                        
	
	$estado = new estadoRecurso;
	$estado->setCodigo($codigoEstado);
	$estado->setReemplazo($reemplazo);
	$estado->setDescripcion("");
	

	
	$vehiculo = new dioscar;
	//$vehiculo->setCodigoFuncionario($codigoVehiculo);
	$vehiculo->setCodigoSimccar($codigo);
	$vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setUnidad($unidad);
	$vehiculo->setUnidadAgregado($unidadAgregado);
	$vehiculo->setOrigen($origen);
	$vehiculo->setVerifica($verificar);
	
	$vehiculo->setTarjetaSimccar($tarjeta);
	$vehiculo->setImei($imei);
	$vehiculo->setMarca(STRTOUPPER($marca));
	$vehiculo->setModelo(STRTOUPPER($modelo));
	$vehiculo->setAnno($anno);
	$vehiculo->setReemplazoSimccar($estado);
	//$vehiculo->setMes($numeroBCU);



	
	$objDBVehiculos = new dbDioscar;
	$resultado = $objDBVehiculos->updateSimccar($vehiculo);

	
	
	
	if ($fechaNuevoEstado != ""){
		$fechaPaso 		= explode("-",$fechaNuevoEstado);
   		$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBVehiculos->updateEstadoSimmcar($vehiculo, $fechaIngresar);
		$resultado = $objDBVehiculos->insertEstadoSimccar($vehiculo, $fechaIngresar);
	}elseif($fechaNuevoEstado == "" && $verificaOculto == "NO"){
		$resultado = $objDBVehiculos->updateSimccar($vehiculo);
	}			
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>