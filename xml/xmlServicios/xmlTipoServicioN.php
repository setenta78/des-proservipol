<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbTipoServicio.class.php");
	require("../../objetos/tipoServicio.class.php");
	
	$grupo		= $_POST['grupo'];
	$codUnidad	= $_POST['codUnidad'];
	
	$objTipo = new dbTipoServicio;
	$objTipo->listaTipoServicioN($codUnidad, $grupo, &$tipoServicios);
	$cantidad = count($tipoServicios);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	for ($i=0; $i<$cantidad; $i++){
		echo "<tipoServicio>";
			echo "<codigo>".$tipoServicios[$i]->getCodigo()."</codigo>";
			echo "<descripcion>".$tipoServicios[$i]->getDescripcion()."</descripcion>";
			echo "<tipo>".$tipoServicios[$i]->getTipo()."</tipo>";
			echo "<activo>".$tipoServicios[$i]->getActivo()."</activo>";
		echo "</tipoServicio>";
	}
	echo "</root>";
?>