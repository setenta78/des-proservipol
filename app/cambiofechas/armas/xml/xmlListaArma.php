<?
	header ('content-type: text/xml');
	include("configuracionBD2.php"); 
	require("../db/dbArmas.class.php");
	require("../objetos/arma.class.php");
	
	$nSerie = $_POST['nSerie'];
	$codigo = $_POST['codigo'];
	
	$objArmas = new dbArmas;
	$objArmas->listaTotalArmas($nSerie,$codigo,&$armas);
	
	$cantidad = count($armas);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	if($cantidad>0){
		for ($i=0; $i < $cantidad; $i++){
			echo "<arma>";
				echo "<codigo>".$armas[$i]->getCodigo()."</codigo>";
				echo "<numeroSerie>".$armas[$i]->getNumeroSerie()."</numeroSerie>";
				echo "<tipo>".$armas[$i]->getTipo()."</tipo>";
				echo "<modelo>".$armas[$i]->getModelo()."</modelo>";
				echo "<unidad>".$armas[$i]->getUnidad()."</unidad>";
			echo "</arma>";
		}
	}
	else{
		echo "VACIO";
	}
	echo "</root>";
	
?>