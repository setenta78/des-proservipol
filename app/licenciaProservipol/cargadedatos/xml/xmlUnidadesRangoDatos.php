<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");
	require("../baseDatos/dbUnidadesRangoDatos.class.php");

  $mes        = $_POST['mes'];
  $anno       = $_POST['anno'];
  $caso       = $_POST['caso'];
  $tipoPivote = $_POST['tipoPivote'];
  $codCluster = $_POST['codCluster'];
  $pivote     = $_POST['pivote'];


	$dbUnidadesRangoDatos = new dbUnidadesRangoDatos;
	$dbUnidadesRangoDatos->listarUnidadesRangoDatos($mes,$anno,$caso,$tipoPivote,$codCluster,$pivote,&$unidad, &$cantidadUnidades);

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
        echo "<sumaCantidad>".utf8_encode($unidad[$i][5])."</sumaCantidad>";
      echo "</unidad>";
    }
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>