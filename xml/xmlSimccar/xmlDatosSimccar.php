<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSimccar.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/estadoRecurso.class.php");
  require("../../objetos/seccion.class.php");
	
	$codigo = $_POST['codigo'];
	$serieSimccar	= strtoupper($_POST['serieSimccar']);
	
	$objFuncionarios = new dbSimccar;
	$objFuncionarios->buscaSimccar($codigo,$serieSimccar,&$simccars);
	$cantidad = count($simccars);
	if ($cantidad > 0){
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>"; 
		
		$fechaPaso 		= explode("-",$simccars->getEstadoSimccar()->getFechaDesde());
		$fechaMostrar = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		
		echo "<simccar>";
			echo "<unidad>".$simccars->getUnidad()->getCodigoUnidad()."</unidad>";
			echo "<descUnidad>".$simccars->getUnidad()->getDescripcionUnidad()."</descUnidad>";
			echo "<codigo>".$simccars->getCodigoSimccar()."</codigo>";
			echo "<serie>".$simccars->getserieSimccar()."</serie>";
			echo "<tarjeta>".$simccars->getTarjetaSimccar()."</tarjeta>";
			echo "<imei>".$simccars->getImei()."</imei>";
			echo "<estado>".$simccars->getEstadoSimccar()->getCodigo()."</estado>";
			echo "<codigoUnidadAgregado>".$simccars->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
			echo "<desUnidadAgregado>".$simccars->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
			echo "<fechaEstado>".$fechaMostrar."</fechaEstado>";
			echo "<origen>".$simccars->getOrigen()."</origen>";
			echo "<verifica>".$simccars->getVerifica()."</verifica>";
			echo "<marca>".$simccars->getMarca()."</marca>";
			echo "<modelo>".$simccars->getModelo()."</modelo>";
			echo "<anno>".$simccars->getAnno()."</anno>";
			echo "<seccion>".$simccars->getSeccion()->getCodigo()."</seccion>";
		echo "</simccar>";
		echo "</root>";
	}else{
		echo "VACIO";
	}
 ?>