<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");
	require("../baseDatos/dbCargaDatos.class.php");

  $mes   = $_POST['mes'];
  $anno  = $_POST['anno'];


	$dbCargaDatos = new dbCargaDatos;
	$dbCargaDatos->listarCargaDatos($mes,$anno,&$tabla, &$cantidadTablas);


if($cantidadTablas > 0)
{
  	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidadTablas; $i++){
      echo "<tabla>";
        echo "<sistema>".$tabla[$i][0]."</sistema>";
        echo "<codTabla>".$tabla[$i][1]."</codTabla>";
        echo "<nombreTabla>".$tabla[$i][2]."</nombreTabla>";
        echo "<cantidadUnidades>".$tabla[$i][3]."</cantidadUnidades>";
        echo "<totalUnidades>".$tabla[$i][4]."</totalUnidades>";
      echo "</tabla>";
    }
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>