<?
  session_start();
	header ('content-type: text/xml');
  include("../../inc/configV4.inc.php");

  $unidad         = $_POST['codigoUnidad'];
	$fechaServicios = explode("-",$_POST['fecha']);

		$sql1 = "
SELECT 
  GRADO.GRA_DESCRIPCION,
  FUNCIONARIO.FUN_NOMBRE,
  FUNCIONARIO.FUN_APELLIDOPATERNO,
  FUNCIONARIO.FUN_APELLIDOMATERNO

FROM
  SERVICIOS_CERTIFICADO
  INNER JOIN FUNCIONARIO ON (SERVICIOS_CERTIFICADO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO AND FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)

WHERE
SERVICIOS_CERTIFICADO.FECHA_SERVICIOS='".$fechaServicios[2]."-".$fechaServicios[1]."-".$fechaServicios[0]."' AND
SERVICIOS_CERTIFICADO.UNI_CODIGO='".$unidad."'
;";

//echo $sql1;


    $CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
		mysql_select_db(DB);



		$result1 = mysql_query($sql1,$CONECT1);
 
    if($myrow1 = mysql_fetch_array($result1))
    {
      echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
      echo "<root>";
          echo "<grado>".$myrow1[GRA_DESCRIPCION]."</grado>";
          echo "<nombre>".$myrow1[FUN_NOMBRE]."</nombre>";
          echo "<apellidoPaterno>".$myrow1[FUN_APELLIDOPATERNO]."</apellidoPaterno>";
          echo "<apellidoMaterno>".$myrow1[FUN_APELLIDOMATERNO]."</apellidoMaterno>";
      echo "</root>";
    }

    else
    {
      echo "VACIO";
    }
?>