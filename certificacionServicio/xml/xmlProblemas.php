<?
  session_start();
	header ('content-type: text/xml');
  include("../../inc/configV4.inc.php");
	
	$sql1 = "SELECT 
  					PROBLEMA.PROB_CODIGO,
  					PROBLEMA.PROB_DESCRIPCION
					FROM PROBLEMA";
	
	//echo $sql1;
	$CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
	mysql_select_db(DB);
	$result1 = mysql_query($sql1,$CONECT1);
	$cantidad = mysql_num_rows($result1);
	if($cantidad>0){
		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		echo "<root>";
	  while($myrow1 = mysql_fetch_array($result1)){
			echo "<problema>";
				echo "<codigo>".$myrow1['PROB_CODIGO']."</codigo>";
				echo "<descripcion>".$myrow1['PROB_DESCRIPCION']."</descripcion>";
			echo "</problema>";
		}
		echo "</root>";
	}
	else{
  	echo "VACIO";
  }
?>