<?
include("../../inc/configV4.inc.php");

	$fechaServicios = explode("-",$_POST['fecha']);
	$unidadUsuario = $_POST['unidad'];
	$problema = $_POST['problema'];
	$codigoUsuario = $_POST['codFuncionario'];
	$ip = $_POST['ip'];
	
	$sql1 = "
     INSERT INTO SERVICIOS_DESVALIDADOS VALUES ('".$unidadUsuario."','".$fechaServicios[2]."-".$fechaServicios[1]."-".$fechaServicios[0]."',CURDATE(),'".$codigoUsuario."','".$ip."','".$problema."');";

  $sql2 = "
     DELETE FROM SERVICIOS_CERTIFICADO WHERE UNI_CODIGO = '".$unidadUsuario."' AND FECHA_SERVICIOS ='".$fechaServicios[2]."-".$fechaServicios[1]."-".$fechaServicios[0]."';";
	
	//  echo $sql1;
  $CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
	mysql_select_db(DB);
	
  $result1 = mysql_query($sql1,$CONECT1);
  $result2 = mysql_query($sql2,$CONECT1);
  
  if(mysql_errno() == 0){echo "OK";}
  else{echo "este es el error:".mysql_error();}
	
  mysql_close();
?>