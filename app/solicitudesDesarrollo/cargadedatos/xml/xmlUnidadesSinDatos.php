<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");
	require("../baseDatos/dbUnidadesSinDatos.class.php");

  $mes      = $_POST['mes'];
  $anno     = $_POST['anno'];
  $codTabla = $_POST['codTabla'];


	$dbUnidadesSinDatos = new dbUnidadesSinDatos;
	$dbUnidadesSinDatos->listarUnidadesSinDatos($mes,$anno,$codTabla,&$unidad, &$cantidadUnidades);

if($cantidadUnidades > 0)
{
  	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidadUnidades; $i++){
      echo "<unidad>";
        echo "<codigoUnidad>".$unidad[$i][0]."</codigoUnidad>";
        echo "<nombreUnidad>".utf8_encode($unidad[$i][1])."</nombreUnidad>";
        echo "<nombreComisaria>".utf8_encode($unidad[$i][2])."</nombreComisaria>";
        echo "<nombrePrefectura>".utf8_encode($unidad[$i][3])."</nombrePrefectura>";
        echo "<nombreZona>".utf8_encode($unidad[$i][4])."</nombreZona>";
      echo "</unidad>";
    }
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>