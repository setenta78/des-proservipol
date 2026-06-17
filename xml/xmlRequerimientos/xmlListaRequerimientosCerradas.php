<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/usuario.class.php");
	require("../../objetos/listaSolicitud.class.php");
	require("../../objetos/estadoRecurso.class.php");
	
	$unidad = $_POST['codigoUnidad'];
	
	$objFuncionarios = new dbRequerimiento;
	$objFuncionarios->listaRequerimientoCerradas($unidad, &$funcionarios);
	$cantidad = count($funcionarios);
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<requerimiento>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoSolicitud()."</codigo>";
   		echo "<problema>".$funcionarios[$i]->getUnidad()."</problema>";
   		echo "<fecha>".$funcionarios[$i]->getFechaSolicitud()."</fecha>";
   		echo "<tipo>".$funcionarios[$i]->getProblema()."</tipo>";
   		echo "<fechaInicio>".$funcionarios[$i]->getSubProblema()."</fechaInicio>";
   		echo "<estado>".$funcionarios[$i]->getTipoMovimiento()."</estado>";
   		echo "<ide>".$funcionarios[$i]->getIdentificadores()."</ide>";
   		echo "<dif>".$funcionarios[$i]->getDiferenciaDias()."</dif>";
   		echo "<implicado>".$funcionarios[$i]->getImplicado()."</implicado>";
   		echo "<codMov>".$funcionarios[$i]->getCodigoTipoMov()."</codMov>";
   		echo "<corr>".$funcionarios[$i]->getCorrelativoMov()."</corr>";
   		
	 	  echo "</requerimiento>";
 	}
	echo "</root>";
 ?>