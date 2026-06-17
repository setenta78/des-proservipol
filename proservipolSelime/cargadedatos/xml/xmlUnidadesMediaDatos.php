<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");
	require("../baseDatos/dbUnidadesMediaDatos.class.php");

  $mes        = $_POST['mes'];
  $anno       = $_POST['anno'];
  $caso       = $_POST['caso'];
  $tipoPivote = $_POST['tipoPivote'];

/*
  $mes        = '2';
  $anno       = '2010';
  $caso       = '0';
  $tipoPivote = 'fms';
*/


	$dbUnidadesMediaDatos = new dbUnidadesMediaDatos;
	$dbUnidadesMediaDatos->listarUnidadesMediaDatos($mes,$anno,$caso,$tipoPivote,&$unidad, &$cantidadUnidades);

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
        echo "<sumaCantidad1>".utf8_encode($unidad[$i][6])."</sumaCantidad1>";
        echo "<sumaCantidad2>".utf8_encode($unidad[$i][7])."</sumaCantidad2>";
        echo "<sumaCantidad3>".utf8_encode($unidad[$i][8])."</sumaCantidad3>";
        echo "<sumaCantidad4>".utf8_encode($unidad[$i][9])."</sumaCantidad4>";
      echo "</unidad>";
    }
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>