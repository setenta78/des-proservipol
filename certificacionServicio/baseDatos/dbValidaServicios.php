<?
include("../../inc/configV4.inc.php");
		
	$fechaServicios = explode("-",$_POST['fecha']);
	$unidadUsuario = $_POST['unidad'];
	$codigoUsuario = strtoupper($_POST['usuario']);
	
  $sql1 = "INSERT INTO SERVICIOS_CERTIFICADO
      		(UNI_CODIGO,
      		FECHA_SERVICIOS,
      		FECHA_CERTIFICADO,
      		FUN_CODIGO)
      		VALUES
      		('".$unidadUsuario."',
      		'".$fechaServicios[2]."-".$fechaServicios[1]."-".$fechaServicios[0]."',
      		'".date("Y-m-d")."',
      		'".$codigoUsuario."');";
		
  $CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
	mysql_select_db(DB);
	
	$result1 = mysql_query($sql1,$CONECT1);
  
  if(mysql_errno() == 0) echo "OK";
  
  mysql_close();