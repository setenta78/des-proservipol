<?
	include("./config2.inc.php"); 
		
	$unidadFuncionario = $_POST['unidadFuncionario'];
	$codigoFuncionario = strtoupper($_POST['codigoFuncionario']);
	
  $sql2 = "
      INSERT INTO USUARIO
      (
        UNI_CODIGO,
        FUN_CODIGO,
        US_USERNAME,
        US_CLAVE,
        US_ACTIVO,
        PER_CODIGO,
        US_FECHACREACION
      )
      VALUES
      (
      '".$unidadFuncionario."',
      '".$codigoFuncionario."',
      '".$codigoFuncionario."',
      '".substr($codigoFuncionario,0,4)."',
      '1',
      '10',
      '".date("Y-m-d")."'
      );";

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