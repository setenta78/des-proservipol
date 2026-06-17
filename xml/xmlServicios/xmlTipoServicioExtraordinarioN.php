<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoServicioExtraordinario.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	
	$codUnidad		= $_POST['codUnidad'];
	
	$objTipo = new dbTipoServicioExtraordinario;
	$objTipo->listaTipoServicioExtraordinarioN($codUnidad, &$tipoServiciosExtraordinarios);
	$cantidad = count($tipoServiciosExtraordinarios);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	for ($i=0; $i<$cantidad; $i++){
		echo "<tipoServicioExtraordinario>";
			echo "<codigo>".$tipoServiciosExtraordinarios[$i]->getCodigo()."</codigo>";
			echo "<descripcion>".$tipoServiciosExtraordinarios[$i]->getDescripcion()."</descripcion>";
	 	echo "</tipoServicioExtraordinario>";
	}
	echo "</root>";
?>