<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbCapacitados.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/perfil.class.php");
	require("../../objetos/capacitacion.class.php");
	
	$unidad 	   	 = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$objFuncionarios = new dbCapacitados;
	$objFuncionarios->listaFuncionariosCapacitados($unidad, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		
   		$fechaPaso 	= explode("-",$funcionarios[$i]->getCapacitacion()->getFechaCapacitacion());
	   	$fechaCapacitacion = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getCargo()->getFechaDesde());
	   	$fechaDesde = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getPerfil()->getFechaPerfil());
	   	$fechaPerfil = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];

   		echo "<funcionario>";
			echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
			echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
			echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
			echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
			echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
			echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
			echo "<codigoCargo>".$funcionarios[$i]->getCargo()->getCodigo()."</codigoCargo>";
			echo "<cargo>".$funcionarios[$i]->getCargo()->getDescripcion()."</cargo>";
			echo "<cargoFecha>".$fechaDesde."</cargoFecha>";
			echo "<codigoPerfil>".$funcionarios[$i]->getPerfil()->getCodigoPerfil()."</codigoPerfil>";
			echo "<descripcionPerfil>".$funcionarios[$i]->getPerfil()->getDescripcionPerfil()."</descripcionPerfil>";
			echo "<fechaPerfil>".$fechaPerfil."</fechaPerfil>";
			echo "<CodUnidadAgregado>".$funcionarios[$i]->getUnidadAgregado()->getCodigoUnidad()."</CodUnidadAgregado>";
			echo "<unidadAgregado>".$funcionarios[$i]->getUnidadAgregado()->getDescripcionUnidad()."</unidadAgregado>";
			echo "<fechaCapacitacion>".$fechaCapacitacion."</fechaCapacitacion>";
			echo "<versionProservipol>".$funcionarios[$i]->getCapacitacion()->getVersionProservipol()."</versionProservipol>";
			echo "<notaProservipol>".$funcionarios[$i]->getCapacitacion()->getNotaProservipol()."</notaProservipol>";
			echo "<codVerificacion>".$funcionarios[$i]->getCapacitacion()->getCodigoVerificacion()."</codVerificacion>";
	 	echo "</funcionario>";
 		}
	echo "</root>";
?>