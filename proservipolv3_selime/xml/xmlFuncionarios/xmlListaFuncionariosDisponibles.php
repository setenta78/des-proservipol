<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
		
	$unidad 	   	= $_POST['codigoUnidad'];
	$fechaServicio	= $_POST['fechaServicio'];
	$tipoServicio	= $_POST['tipoServicio'];
	$correlativo	= $_POST['correlativo'];
	$servicio		= $_POST['servicio'];
		
	$fechaPaso 		= explode("-",$fechaServicio);
   	$fechaBuscar  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   	
   	//$unidad 	   	= 3890;
	//$fechaBuscar	= "2010-08-29";
	//$tipoServicio	= 10;
	//$correlativo  = 43
		
	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->listaFuncionariosDisponibles($unidad, $fechaBuscar, $tipoServicio, $correlativo, $servicio, &$funcionarios);
	$cantidad = count($funcionarios);
	if ($cantidad > 0){
  		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  		echo "<root>";
   		for ($i=0; $i<$cantidad; $i++){
   			echo "<funcionario>";
   			echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   			echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   			echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   			echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   			echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
		 	echo "</funcionario>";
 		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>