<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFerper.class.php");
	require("../../objetos/ferper.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/unidad.class.php");
	
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$objFuncionarios = new dbFerper;
	$objFuncionarios->listaTotalFuncionarios($unidad, $nombreBuscar, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		
   		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoPermiso()->getFechaInicio());
	   	$fechaI			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoPermiso()->getFechaTermino());
	   	$fechaT			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoPermiso()->getFechaTerminoReal());
	   	$fechaTReal	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   		
   		echo "<funcionario>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
   		echo "<tipoPermiso>".$funcionarios[$i]->getTipoPermiso()->getTipoPermiso()."</tipoPermiso>";
   		echo "<permiso>".$funcionarios[$i]->getDescripcionPermiso()."</permiso>";
   		echo "<rut>".$funcionarios[$i]->getTipoPermiso()->getRutFuncionario()."</rut>";
   		echo "<folio>".$funcionarios[$i]->getTipoPermiso()->getFolio()."</folio>";
   		echo "<archivo>".$funcionarios[$i]->getTipoPermiso()->getArchivoPermiso()."</archivo>";
   		echo "<usuarioProservipol>".$funcionarios[$i]->getTipoPermiso()->getUsuarioProservipol()."</usuarioProservipol>";
   		echo "<fecha_inicio>".$fechaI."</fecha_inicio>";
   		echo "<fecha_termino>".$fechaT."</fecha_termino>";
   		echo "<fecha_termino_real>".$fechaTReal."</fecha_termino_real>";
	 	echo "</funcionario>";
 	}
	echo "</root>";
?>