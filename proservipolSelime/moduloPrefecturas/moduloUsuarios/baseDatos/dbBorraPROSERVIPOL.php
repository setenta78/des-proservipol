<?
	include("./config1.inc.php"); 
		
	$codigoFuncionario = strtoupper($_POST['codigoFuncionario']);
	
	//$codigoFuncionario = "982216K";

  $sql1 = "
      DELETE FROM USUARIO
      WHERE
      USUARIO.FUN_CODIGO='".$codigoFuncionario."'
      ;";

  //echo $sql1;

  $CONECT1 = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
  mysql_select_db(DB_DB_1);

  $result1 = mysql_query($sql1,$CONECT1);
  if(mysql_errno() == 0)
  {
    echo "OK";
  }
  //echo "este es el error:".mysql_error();
  mysql_close();
?>