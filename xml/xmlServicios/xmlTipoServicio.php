<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoServicio.class.php");
	require("../../objetos/tipoServicio.class.php");
	
	$grupo		= $_POST['grupo'];
	$codUnidad	= $_POST['codUnidad'];
	
	$objTipo = new dbTipoServicio;
	$objTipo->listaTipoServicio($codUnidad, $grupo, &$tipoServicios);
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
 	
 	if($codUnidad==2165&&$grupo=='OPERATIVO'){
 		
 		echo "<tipoServicio>";
		echo "<codigo>538</codigo>";
		echo "<descripcion>1do Turno Casco Historico</descripcion>";
		echo "<tipo>O</tipo>";
		echo "<activo>1</activo>";
		echo "</tipoServicio>";
		
 		echo "<tipoServicio>";
		echo "<codigo>539</codigo>";
		echo "<descripcion>2do Turno Casco Historico</descripcion>";
		echo "<tipo>O</tipo>";
		echo "<activo>1</activo>";
		echo "</tipoServicio>";
 	}
	echo "</root>";
?>