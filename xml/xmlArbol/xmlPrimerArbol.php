<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbArbolUnidades.class.php");
	require("../../objetos/arbolUnidad.class.php");

	$codPadre = $_POST['codPadre'];
	$perfil = $_POST['perfil'];
	
	$objUnidades = new dbUnidad;
	$objUnidades->PrimerArbolUnidades($codPadre,$perfil,&$unidades);

	$cantidad = count($unidades);
	
	if($unidades!=""){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		for ($i=0; $i < $cantidad; $i++){
			echo "<unidad>";
		  		echo "<codigo>".$unidades[$i]->getCodigoUnidad()."</codigo>";
				echo "<nombre>".$unidades[$i]->getNombreUnidad()."</nombre>";
				echo "<codigoPadre>".$unidades[$i]->getCodigoPadre()."</codigoPadre>";
				echo "<tipo>".$unidades[$i]->getCodigoTipo()."</tipo>";
				echo "<especialidad>".$unidades[$i]->getEspecialidad()."</especialidad>";
				echo "<cuadrante>".$unidades[$i]->getCuadrante()."</cuadrante>";
				echo "<jerarquia>".$unidades[$i]->getJerarquia()."</jerarquia>";	 		
			echo "</unidad>";
		}
		echo "</root>";
	}
	else{
		echo "VACIO";
	}
?>