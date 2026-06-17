<?
	header ('content-type: text/xml');
  include("../../inc/configV4.inc.php");
	
  $sql = "SELECT 
  		M.MED_COD,
  		M.MED_DESCRIPCION
		FROM ESPECIALIDAD_MEDICA M";
	
	$CONECT = @mysql_connect(HOST,DB_USER,DB_PASS);
  mysql_select_db(DB);

  $result = mysql_query($sql,$CONECT);
	mysql_close();
 	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
 
  while($myrow = mysql_fetch_array($result)){
  	
  	$codigo = $myrow["MED_COD"];
  	$descripcion = $myrow["MED_DESCRIPCION"];
  	
  	echo "<especialidad>";
  	echo "<codigo>".$codigo."</codigo>";
  	echo "<descripcion>".$descripcion."</descripcion>";
  	echo "</especialidad>";
  }
  
  echo "</root>";
 	
?>