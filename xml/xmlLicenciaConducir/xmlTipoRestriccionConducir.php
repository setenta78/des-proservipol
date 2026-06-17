<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoRestriccionConducir.class.php");
	require("../../objetos/tipoRestriccionConducir.class.php");
		
	$tipo = $_POST['tipo'];	
	
	if ($tipo == "SEMEP") $filtroTipoRestriccion = 1;
	if ($tipo == "MUNICIPAL") $filtroTipoRestriccion = 2;
		
	$objTipoRestriccionConducir = new dbTipoRestriccionConducir;
	$objTipoRestriccionConducir->listaTipoRestriccionConducir($filtroTipoRestriccion, &$tiposDeRestriccionConducir);
	$cantidad = count($tiposDeRestriccionConducir);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
  	echo "<tiposDeRestriccionConducir>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<restriccionConducir>";
   		echo "<codigo>".$tiposDeRestriccionConducir[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$tiposDeRestriccionConducir[$i]->getDescripcion()."</descripcion>";
	 	echo "</restriccionConducir>";
 	}           
 	echo "</tiposDeRestriccionConducir>";   
	echo "</root>";
 ?>