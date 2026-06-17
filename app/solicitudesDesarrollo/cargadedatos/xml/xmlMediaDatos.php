<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");
	require("../baseDatos/dbMediaDatos.class.php");

  $mes   = $_POST['mes'];
  $anno  = $_POST['anno'];
  $caso  = $_POST['caso'];

/*
  $mes   = '2';
  $anno  = '2010';
  $caso  = '0';
*/

	$dbMediaDatos = new dbMediaDatos;
	$dbMediaDatos->listarMediaDatos($mes,$anno,$caso,&$tabla, &$cantidadTablas);

if($cantidadTablas > 0)
{
  	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidadTablas; $i++){
      echo "<tabla>";
            echo "<sistema>".$tabla[0]."</sistema>";
            echo "<codTabla>".$tabla[1]."</codTabla>";
            echo "<nombreTabla>".$tabla[2]."</nombreTabla>";
            echo "<campo>".$tabla[3]."</campo>";
            echo "<unidadesConDatos>".$tabla[4]."</unidadesConDatos>";
            echo "<unidadesFueraMediaSup>".$tabla[5]."</unidadesFueraMediaSup>";
            echo "<unidadesFueraMediaInf>".$tabla[6]."</unidadesFueraMediaInf>";
      echo "</tabla>";
    }
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>