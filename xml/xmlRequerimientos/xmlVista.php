<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/vista.class.php");
	
	$unidad = $_POST['unidad'];
	$usuario	= strtoupper($_POST['usuario']);
	
	$objFuncionarios = new dbRequerimiento;
	$objFuncionarios->datoUsuario($unidad,$usuario,&$vistas);
	$cantidad = count($vistas);
	if ($cantidad > 0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>"; 
			echo "<vista>";
				echo "<unidad>".$vistas->getCodigoUnidad()."</unidad>";
				echo "<destacamento>".$vistas->getDestacamento()."</destacamento>";
				echo "<funcionario>".$vistas->getFuncionario()."</funcionario>";
				echo "<nombre>".$vistas->getNomFuncionario()."</nombre>";
				echo "<tipo>".$vistas->getTipoUsuario()."</tipo>";
				echo "<grado>".$vistas->getGrado()."</grado>";
			echo "</vista>";
		echo "</root>";
	}else{
		echo "VACIO";
	}
?>