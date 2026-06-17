<?
	include("./config2.inc.php"); 
		
	$codigoFuncionario = strtoupper($_POST['codigoFuncionario']);
	
	//$codigoFuncionario = "982216K";

  $sql2 = "
      UPDATE USUARIO
      SET USUARIO.US_CLAVE='".substr($codigoFuncionario,0,4)."'
      WHERE
      USUARIO.FUN_CODIGO='".$codigoFuncionario."'
      ;";

  //echo $sql2;

  $CONECT2 = @mysql_connect(DB_HOST_2,DB_USER_2,DB_PASS_2);
  mysql_select_db(DB_DB_2);

  $result2 = mysql_query($sql2,$CONECT2);
  if(mysql_errno() == 0)
  {
    echo "OK";
  }
  //echo "este es el error:".mysql_error();
  mysql_close();
?>