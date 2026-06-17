<?
  session_start();	
	header ('content-type: text/xml');
  include("../../inc/configV4.inc.php");
	
  $codVehiculo = $_POST['codigoVehiculo'];
  //$unidad=7800;
	
  $sql1 = "SELECT IF(ISNULL(MAX(ESTADO_VEHICULO.CORRELATIVO_ESTADOVEHICULO)),0,MAX(ESTADO_VEHICULO.CORRELATIVO_ESTADOVEHICULO)) AS ULTIMO
					 FROM ESTADO_VEHICULO
					 WHERE ESTADO_VEHICULO.VEH_CODIGO = ". $codVehiculo;
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
  
    }else
    {
      echo "VACIO";
    }
?>





