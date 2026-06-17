<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbEstadoRecurso.class.php");
	require("../../objetos/estadoRecurso.class.php");
			
	$objEstado = new dbEstadoRecurso;
	$objEstado->listaEstadosRecursos(&$estados);
	$cantidad = count($estados);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<estado>";
   		echo "<codigo>".$estados[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$estados[$i]->getDescripcion()."</descripcion>";
	 	echo "</estado>";
 	}
	echo "</root>";
 ?>