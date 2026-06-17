<?
	header ('content-type: text/xml');
	include("../configuracionBDSelime.php");
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/licenciaMedica.class.php");
	
	$color = $_POST['color'];
	$folio = $_POST['folio'];
	$estado = $_POST['estado'];
	
	$cant = strlen($folio);
	for($i=10;$i > $cant;$i--){
		$folio = "0".$folio;
	}
	
	$estado = $estado+1;
	
	$funcionario = new licenciaMedica;
	$funcionario->setColor($color);
	$funcionario->setFolio($folio);
	$funcionario->setEstadoLicencia($estado);
	
	$objDBFuncionarios = new dbLicencia;
	$resultado = $objDBFuncionarios->updateAnulaLicenciaSelime($funcionario);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
?>