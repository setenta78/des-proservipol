<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");
	require("../baseDatos/dbArbolUnidad.class.php");
	require("../objetos/arbolUnidad.class.php");


  $unidad               = $_POST['codigoUnidad'];

/*
  $padre               = '460';
*/
				
	$objdbArbolUnidad = new dbArbolUnidad;
	$objdbArbolUnidad->listarArbolUnidadArriba($unidad,&$listadoArbolUnidad, &$cantidadArbolUnidad);


if($cantidadArbolUnidad > 0)
{
  	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidadArbolUnidad; $i++){
      echo "<arbolUnidad>";
        echo "<unidad>".$listadoArbolUnidad[$i]->getUnidad()."</unidad>";
        echo "<padre>".$listadoArbolUnidad[$i]->getPadre()."</padre>";
        echo "<descripcion>".$listadoArbolUnidad[$i]->getDescripcion()."</descripcion>";
        echo "<planCuadrante>".$listadoArbolUnidad[$i]->getPlanCuadrante()."</planCuadrante>";
      echo "</arbolUnidad>";
    }
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>