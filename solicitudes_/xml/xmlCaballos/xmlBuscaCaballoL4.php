<?
	header ('content-type: text/xml');
	include("../configuracionBDL4.php"); 
	require("../../baseDatos/dbCaballos.class.php");
	require("../../objetos/caballos.class.php");

	//session_start();
	
	$bcuVehiculo  = $_POST['codigoVehiculo'];


  //$bcuVehiculo = "03076100178";
		
	$objVehiculos = new dbCaballos;
	$objVehiculos->buscaCaballoL4($bcuVehiculo, &$caballos);
	$cantidad = count($caballos);
	if ($cantidad > 0){    
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<caballo>";
   	 echo "<bcu>".$caballos->getNumeroBCU()."</bcu>";
   	 echo "<nombre>".$caballos->getNombreCaballo()."</nombre>";
     echo "<fecha>".$caballos->getFechaNacimiento()."</fecha>";
     echo "<raza>".$caballos->getRaza()."</raza>";
     echo "<sexo>".$caballos->getSexo()."</sexo>";
     echo "<pelaje>".$caballos->getPelaje()."</pelaje>";
     echo "<color>".$caballos->getColor()."</color>";
	 	echo "</caballo>";
  echo "</root>";
  }else {
		echo "VACIO";
	}
 ?>