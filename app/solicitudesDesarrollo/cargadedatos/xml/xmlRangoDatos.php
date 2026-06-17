<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");
	require("../baseDatos/dbRangoDatos.class.php");

  $mes   = $_POST['mes'];
  $anno  = $_POST['anno'];
  $caso  = $_POST['caso'];

/*
  $mes   = '1';
  $anno  = '2010';
  $caso  = '1';
*/

	$dbRangoDatos = new dbRangoDatos;
	$dbRangoDatos->listarRangoDatos($mes,$anno,$caso,&$tabla, &$cantidadTablas);

if($cantidadTablas > 0)
{
  	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
  	echo "<root>";
      echo "<tabla>";
            echo "<sistema>".$tabla[1][0]."</sistema>";
            echo "<codTabla>".$tabla[1][1]."</codTabla>";
            echo "<nombreTabla>".$tabla[1][2]."</nombreTabla>";
            echo "<campo>".$tabla[1][3]."</campo>";
            for ($j=1; $j<=8; $j++){
              echo "<cluster>";
                  echo "<codCluster>".$tabla[$j][4]."</codCluster>";
                  echo "<unidadesConDatos>".$tabla[$j][5]."</unidadesConDatos>";
                  echo "<unidadesFueraRangoSup>".$tabla[$j][6]."</unidadesFueraRangoSup>";
                  echo "<unidadesExtFueraRangoSup>".$tabla[$j][7]."</unidadesExtFueraRangoSup>";
                  echo "<unidadesFueraRangoInf>".$tabla[$j][8]."</unidadesFueraRangoInf>";
                  echo "<unidadesExtFueraRangoInf>".$tabla[$j][9]."</unidadesExtFueraRangoInf>";
                  echo "<primerCuartil>".$tabla[$j][10]."</primerCuartil>";
                  echo "<tercerCuartil>".$tabla[$j][11]."</tercerCuartil>";
              echo "</cluster>";
            }
      echo "</tabla>";
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>