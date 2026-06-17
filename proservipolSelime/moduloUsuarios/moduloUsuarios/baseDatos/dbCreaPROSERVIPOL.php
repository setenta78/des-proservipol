<?
	include("./config1.inc.php"); 
		
	$codigoFuncionario = strtoupper($_POST['codigoFuncionario']);
	$unidadUsuario = $_POST['unidadUsuario'];
	$tipoUsuario = $_POST['tipoUsuario'];
	

  $sql1 = "
      INSERT INTO USUARIO
      (
      FUN_CODIGO,
      UNI_CODIGO,
      US_LOGIN,
      US_PASSWORD,
      TUS_CODIGO,
      US_FECHACREACION
      )
      VALUES
      (
      '".$codigoFuncionario."',
      '".$unidadUsuario."',
      '".$codigoFuncionario."',
      '".substr($codigoFuncionario,0,4)."',
      '".$tipoUsuario."',
      '".date("Y-m-d")."'
      )
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