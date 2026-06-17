<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	include("../configuracionBDPersonal.php");
	require("../../baseDatos/dbFuncionariosComparar.class.php");
	require("../../objetos/funcionarioComparar.class.php");
	require("../../objetos/grado.class.php");

	$unidad 	   = $_POST['codigoUnidad'];
	
	//$unidad = "460"; 
	//$nombreBuscar = "4";

	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->listaTotalFuncionarios($unidad, &$funcionarios, &$error);

if($error=="")
{
    $cantidad = count($funcionarios);
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<funcionario>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
   		echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
   		echo "<observacion>".$funcionarios[$i]->getObservacion()."</observacion>";
	 	echo "</funcionario>";
    }

    echo "</root>";
}
else
{
    echo $error;
}
?>