<?
	header ('content-type: text/xml');
	include("../configuracionBDL4.php"); 
	require("../../baseDatos/dbAnimales.class.php");
	require("../../objetos/animal.class.php");

	//session_start();
	$bcuAnimal  = $_POST['codigoAnimal'];
  //$bcuAnimal = "03076100178";
		
	$objAnimal = new dbAnimal;
	$objAnimal->buscaCaballoL4($bcuAnimal, &$Animales);
	$cantidad = count($Animales);
	if ($cantidad > 0){    
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<animal>";
   	 echo "<bcu>".$Animales->getNumeroBCU()."</bcu>";
   	 echo "<nombre>".$Animales->getNombreAnimal()."</nombre>";
     echo "<fecha>".$Animales->getFechaNacimiento()."</fecha>";
     echo "<raza>".$Animales->getRaza()."</raza>";
     echo "<sexo>".$Animales->getSexo()."</sexo>";
     echo "<pelaje>".$Animales->getPelaje()."</pelaje>";
     echo "<color>".$Animales->getColor()."</color>";
	 	echo "</animal>";
  echo "</root>";
  }else {
		echo "VACIO";
	}
 ?>