<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbTipoServicioExtraordinario.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");


	$especialidad = $_POST['especialidad'];
	if ($especialidad <> 30 and $especialidad <> 31) $especialidad = 70;       
		
	$objTipo = new dbTipoServicioExtraordinario;
	$objTipo->listaTipoServicioExtraordinario($especialidad, &$tipoServiciosExtraordinarios);
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