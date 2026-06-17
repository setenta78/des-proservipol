<?
	header ('content-type: text/xml');
	include("../configuracionBD4Mysqli.php");
	require("../../baseDatos/dbCamarasCorporales.class.php");
	require("../../objetos/camara.class.php");
	require("../../objetos/estadoCamara.class.php");
	require("../../objetos/unidad.class.php");
	
	$codCamara				= $_POST['codigoCamara'];
	$codUnidad				= $_POST['codigoUnidad'];
	$codEstado				= $_POST['codigoEstado'];
	$fechaEstado			= $_POST['fechaEstado'];
	$codUnidadAgr			= $_POST['codigoUnidadAgregado'];
	
	if ($codUnidadAgr == "") $codUnidadAgr = "Null";

	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codUnidadAgr);
	$unidadAgregado->setDescripcionUnidad("");

	$estado = new estadoCamara;
	$estado->setCodigo($codEstado);
	$estado->setDescripcion("");
	$estado->setFechaDesde(null);
	
	if($fechaEstado!=''){
		$fechaPaso			= explode("-",$fechaEstado);
		$fechaEstadoDesde	= $fechaPaso[2].$fechaPaso[1].$fechaPaso[0];
		$estado->setFechaDesde($fechaEstadoDesde);
	}
	
	$camara	= new camara;
	$camara->setcodigo($codCamara);
	$camara->setEstado($estado);
	$camara->setUnidad($unidad);
	$camara->setUnidadAgregado($unidadAgregado);
	
	$objDBCamaras = new dbCamaras;
	$resultado = $objDBCamaras->actualizarEstadoCamara_mysqli($camara);

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
 	echo "<resultado>".$resultado."</resultado>";
 	echo "</root>";
?>