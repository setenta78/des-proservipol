<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config1.inc.php");
	require("../baseDatos/dbArbolUnidad.class.php");
	require("../objetos/arbolUnidad.class.php");


  $padre               = $_POST['codigoPadre'];

/*
  $padre               = '460';
*/
				
	$objdbArbolUnidad = new dbArbolUnidad;
	$objdbArbolUnidad->listarArbolUnidad($padre,&$listadoArbolUnidad, &$cantidadArbolUnidad);


if($cantidadArbolUnidad > 0)
{
  	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidadArbolUnidad; $i++){
      echo "<arbolUnidad>";
        echo "<unidad>".$listadoArbolUnidad[$i]->getUnidad()."</unidad>";
        echo "<padre>".$listadoArbolUnidad[$i]->getPadre()."</padre>";
        echo "<descripcion>".utf8_encode($listadoArbolUnidad[$i]->getDescripcion())."</descripcion>";
        echo "<tipoUnidad>".$listadoArbolUnidad[$i]->getTipoUnidad()."</tipoUnidad>";
      echo "</arbolUnidad>";
    }
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>