<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoServicio.class.php");
	require("../../objetos/grupoServicio.class.php");
	
	$codUnidad = $_POST['codUnidad'];
	
	$objGrupo = new dbTipoServicio;
	$objGrupo->listaGrupoTipoServicio($codUnidad, &$grupoServicios);
	$cantidad = count($grupoServicios);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	for ($i=0; $i<$cantidad; $i++){
		echo "<grupoServicio>";
			echo "<codigo>".$grupoServicios[$i]->getCodigo()."</codigo>";
			echo "<descripcion>".$grupoServicios[$i]->getDescripcion()."</descripcion>";
		echo "</grupoServicio>";
 	}
 	
	echo "</root>";
?>