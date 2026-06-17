<?
  session_start();	
	header ('content-type: text/xml');
  include("../../inc/configV4.inc.php");
	
  $unidad = $_POST['unidad'];
  //$unidad=7800;
	
  $sql1 = "SELECT MAX(CORRELATIVO_SERVICIO) AS ULTIMO FROM SERVICIO WHERE UNI_CODIGO =". $unidad;
	//echo $sql1 . "\n\n";
	
	$CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
  mysql_select_db(DB);

  $result1 = mysql_query($sql1,$CONECT1);
	mysql_close();
 
  if($myrow1 = mysql_fetch_array($result1)){
      echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
      echo "<root>";
      echo "<ultimoCorrelativo>".$myrow1["ULTIMO"]."</ultimoCorrelativo>";
      echo "</root>";
  }
  else{
     	echo "VACIO";
  }
?>