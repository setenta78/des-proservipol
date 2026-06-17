<?
  session_start();
	header ('content-type: text/xml');
	include("./config1.inc.php");

  $codigoPerfil         = $_SESSION['USUARIO_CODIGOPERFIL'];
	$codigoUnidadUsuario  = $_SESSION['USUARIO_CODIGOUNIDAD'];

  $anno  = $_POST['anno'];
  $mes   = $_POST['mes'];
  $dia   = $_POST['dia'];

  //$perfilConsulta= "";

/*
  $anno  = 2011;
  $mes   = 03;
  $dia   = 01;
*/
/*
    if($codigoPerfil==30)
    {
        $perfilConsulta= "AND (UNIDAD.UNI_CODIGO=".$codigoUnidadUsuario." OR UNIPADRE.UNI_CODIGO=".$codigoUnidadUsuario.")";
    }
*/

    if($codigoPerfil==40)
    {
        $perfilConsulta= "AND (UNIPADRE.UNI_CODIGO=".$codigoUnidadUsuario." OR UNIPADRE2.UNI_CODIGO=".$codigoUnidadUsuario.")";
    }

    else if($codigoPerfil==50)
    {
        $perfilConsulta= "AND (UNIPADRE2.UNI_CODIGO=".$codigoUnidadUsuario." OR UNIPADRE3.UNI_CODIGO=".$codigoUnidadUsuario.")";
    }

    else if($codigoPerfil==60)
    {
        $perfilConsulta= "";
    }


		$sql1 = "
SELECT
DISTINCT USUARIO.UNI_CODIGO AS UNI_CODIGO

FROM USUARIO

INNER JOIN UNIDAD ON
(UNIDAD.UNI_CODIGO=USUARIO.UNI_CODIGO)

LEFT JOIN UNIDAD AS UNIPADRE ON
(UNIPADRE.UNI_CODIGO=UNIDAD.UNI_PADRE)

LEFT JOIN UNIDAD AS UNIPADRE2 ON
(UNIPADRE2.UNI_CODIGO=UNIPADRE.UNI_PADRE)

LEFT JOIN UNIDAD AS UNIPADRE3 ON
(UNIPADRE3.UNI_CODIGO=UNIPADRE2.UNI_PADRE)

LEFT JOIN UNIDAD AS UNIPADRE4 ON
(UNIPADRE4.UNI_CODIGO=UNIPADRE3.UNI_PADRE)

WHERE USUARIO.UNI_CODIGO NOT IN
(
	SELECT DISTINCT UNIDAD.UNI_PADRE
	FROM UNIDAD
    WHERE UNIDAD.UNI_PADRE IS NOT NULL
)

AND USUARIO.UNI_CODIGO NOT IN
(
	SELECT DISTINCT SERVICIO.UNI_CODIGO
	FROM SERVICIO
	WHERE SERVICIO.FECHA='".$anno."-".$mes."-".$dia."'
)

".$perfilConsulta."";

    $CONECT1 = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
		mysql_select_db(DB_DB_1);


		$result1 = mysql_query($sql1,$CONECT1);
 
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    echo "<root>";

    if($dia=="01")
    {
      echo "<hora>".date("d-m-Y h:i:s A")."</hora>";
    }

    while($myrow1 = mysql_fetch_array($result1))
    {
        echo "<unidad>";
          echo "<codigoUnidad>".$myrow1[UNI_CODIGO]."</codigoUnidad>";
        echo "</unidad>";
    }
    echo "</root>";


?>









