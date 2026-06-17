<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbTipoServicio.class.php");
	require("../../objetos/tipoServicio.class.php");

	$especialidad = $_POST['especialidad'];
	$grupo = $_POST['grupo'];
	
	//$grupo = 'OPERATIVO';
	//Agregada condicion el 30-04-2015
    //and $especialidad <> 80
	
	if ($especialidad <> 30 and $especialidad <> 31 and $especialidad <> 40 and $especialidad <> 41 and $especialidad <> 50 and $especialidad <> 60 and $especialidad <> 80 and $especialidad <> 32) $especialidad = 70;
		
	$objTipo = new dbTipoServicio;
	$objTipo->listaTipoServicio($especialidad, $grupo, &$tipoServicios);
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