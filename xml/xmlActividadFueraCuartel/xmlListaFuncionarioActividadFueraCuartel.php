<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbActividadFueraCuartel.class.php");
	require("../../objetos/actividadFueraCuartel.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$objFuncionarios = new dbActividadFueraCuartel;
	$objFuncionarios->listaTotalFuncionarios($unidad, $nombreBuscar, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		
   		$fechaPaso 	= explode("-",$funcionarios[$i]->getActividadFueraCuartel()->getFechaInicio());
	   	$fechaI		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getActividadFueraCuartel()->getFechaTermino());
	   	$fechaT		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getActividadFueraCuartel()->getFechaInicioReal());
	   	$fechaIReal	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getActividadFueraCuartel()->getFechaTerminoReal());
	   	$fechaTReal	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   		
   		echo "<funcionario>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<apellido1>".$funcionarios[$i]->getApellidoPaterno()."</apellido1>";
   		echo "<apellido2>".$funcionarios[$i]->getApellidoMaterno()."</apellido2>";
   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
   		echo "<rut>".$funcionarios[$i]->getActividadFueraCuartel()->getRutFuncionario()."</rut>";
   		echo "<tipoActividad>".$funcionarios[$i]->getActividadFueraCuartel()->getTipoActividad()."</tipoActividad>";
   		echo "<codActividad>".$funcionarios[$i]->getActividadFueraCuartel()->getCodActividadFueraCuartel()."</codActividad>";
   		echo "<archivo>".$funcionarios[$i]->getActividadFueraCuartel()->getArchivo()."</archivo>";
   		echo "<usuarioProservipol>".$funcionarios[$i]->getActividadFueraCuartel()->getUsuarioProservipol()."</usuarioProservipol>";
   		echo "<unidad>".$funcionarios[$i]->getActividadFueraCuartel()->getUnidad()."</unidad>";
   		echo "<fecha_inicio>".$fechaI."</fecha_inicio>";
   		echo "<fecha_termino>".$fechaT."</fecha_termino>";
   		echo "<fecha_inicio_real>".$fechaIReal."</fecha_inicio_real>";
   		echo "<fecha_termino_real>".$fechaTReal."</fecha_termino_real>";
	 	echo "</funcionario>";
 	}
	echo "</root>";
?>