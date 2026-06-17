<?
//	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");

//--- CONTENIDO COMUN INICIO PDF
include ('../imprimible/class.ezpdf.php');
$pdf =new Cezpdf();
$pdf->selectFont('../imprimible/fonts/Helvetica.afm');
$pdf->ezText("<b>CARABINEROS DE CHILE</b>",10);
$pdf->ezText("<b>PROSERVIPOL V3.0</b>",10);
$pdf->ezText("",12);
//------------------------------

		
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$escalafon    = $_POST['escalafon'];
	$grado   	  = $_POST['grado'];
	
	$unidad = "10"; 
	//$nombreBuscar = "4";

	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->listaTotalFuncionarios($unidad, $nombreBuscar, $escalafon, $grado, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
	
$filasEncabezado[]=array("UNIDAD",":",$unidad );
$tituloTabla=array("No.","CODIGO","NOMBRE","GRADO","CARGO");

	
//  	echo "<\?xml version=\"1.0\" encoding=\"ISO-8859-1\"?\>";
//  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
//   		echo "<funcionario>";

$filasTabla[]=array
(
$i+1,
$funcionarios[$i]->getCodigoFuncionario(),
$funcionarios[$i]->getApellidoPaterno()." ".$funcionarios[$i]->getApellidoMaterno().", ".$funcionarios[$i]->getPNombre()." ".$funcionarios[$i]->getSNombre(),
$funcionarios[$i]->getGrado()->getDescripcion(),
$funcionarios[$i]->getCargo()->getDescripcion()
);
/*
   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
   		echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
   		echo "<cargo>".$funcionarios[$i]->getCargo()->getDescripcion()."</cargo>";
*/

//	 	echo "</funcionario>";
 	}
//	echo "</root>";


//--- CONTENIDO COMUN FINAL PDF
$pdf->ezTable($filasEncabezado,'','',array('showHeadings'=>0,'shaded'=>0,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right'));
$pdf->ezText("",12);
$pdf->ezTable($filasTabla,$tituloTabla,'',array('fontSize'=>8,'width'=>'540'));
$pdf->ezStream();
//----------------------------- 



?>