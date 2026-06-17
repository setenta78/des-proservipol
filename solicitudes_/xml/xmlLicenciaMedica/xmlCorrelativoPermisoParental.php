<?
  session_start();	
	header ('content-type: text/xml');
  include("../../inc/configV3.inc.php");
	
  $unidad = $_POST['unidad'];
  //$unidad=7800;
	
  $sql1 = "SELECT IF(ISNULL(MAX(L.FOLIO_LICENCIA)), 1, MAX(CAST(L.FOLIO_LICENCIA AS UNSIGNED))) FOLIO
					FROM LICENCIA_MEDICA L
					WHERE L.COLOR_LICENCIA = 'PP' AND L.UNI_CODIGO = ".$unidad;
;
	//echo $sql1 . "\n\n";
	
	$CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
  mysql_select_db(DB);

  $result1 = mysql_query($sql1,$CONECT1);
	mysql_close();
 
  if($myrow1 = mysql_fetch_array($result1)){	
  	$correlativo = str_replace($unidad."00", "", $myrow1["FOLIO"]);
  	$correlativo ++;
  	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
  	echo "<root>";
  	echo "<ultimoCorrelativo>".$correlativo."</ultimoCorrelativo>";
  	echo "</root>";
  }
  else{
  	echo "VACIO";
  }
?>