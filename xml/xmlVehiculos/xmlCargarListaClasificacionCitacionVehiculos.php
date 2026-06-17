<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbClasificacionCitacion.class.php");
    
	$ListaCausas  = unserialize(stripslashes($_POST['lista']));
    //print_r($ListaCausas);
    
	$objDBVehiculos = new dbClasificacionCitacion;
	$resultado = $objDBVehiculos->insertClasificacionCitacion($ListaCausas);
    if($resultado > 0){
        echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
        echo "<root>";
        echo "<resultado>".$resultado."</resultado>";
        echo "</root>";
    }
    else{
        echo "VACIO";
    }
?>