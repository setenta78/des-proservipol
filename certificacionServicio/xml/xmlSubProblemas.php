<?
  session_start();
	header ('content-type: text/xml');
  include("../../inc/configV4.inc.php");
	
	$problema = $_POST['problema'];
	
	$sql1 = "SELECT SUBPROBLEMA.SUBP_CODIGO,
  								SUBPROBLEMA.SUBP_DESCRIPCION
					FROM SUBPROBLEMA
					WHERE SUBPROBLEMA.PROB_CODIGO = '".$problema."'";
	
	//echo $sql1;
	$CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
	mysql_select_db(DB);
	$result1 = mysql_query($sql1,$CONECT1);
	$cantidad = mysql_num_rows($result1);
	if($cantidad>0){
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
		echo "<root>";
	  while($myrow1 = mysql_fetch_array($result1)){
			echo "<subproblema>";
				echo "<codigo>".$myrow1['SUBP_CODIGO']."</codigo>";
				echo "<descripcion>".$myrow1['SUBP_DESCRIPCION']."</descripcion>";
			echo "</subproblema>";
  	}
  	echo "</root>";
	}
	else{
  	echo "VACIO";
  }
?>