<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbGrados.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/escalafon.class.php");
		
	$escalafonCodigo 	  = $_POST['escalafonCodigo'];
	$escalafonDescripcion = $_POST['escalafonDescripcion'];
	
	//$escalafonCodigo 	  = "110100";
	//$escalafonDescripcion = "ESC. DE ORDEN Y SEG. (PNS)";
	
	//ECHO "escalafon " . $escalafonCodigo . " - " . $escalafonDescripcion;
	
	$escalafon = new escalafon;
	$escalafon->setCodigo($escalafonCodigo);
	$escalafon->setDescripcion($escalafonDescripcion);
	
	$objGrado = new dbGrados;
	$objGrado->listaGrados($escalafon, &$grados);
	$cantidad = count($grados);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<grado>";
   		echo "<codigo>".$grados[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$grados[$i]->getDescripcion()."</descripcion>";
	 	echo "</grado>";
 	}
	echo "</root>";
 ?>