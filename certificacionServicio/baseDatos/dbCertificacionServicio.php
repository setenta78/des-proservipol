<?
	header ('content-type: text/xml');
  include("../../inc/configV4.inc.php");

  //$codigoPerfil         = $_SESSION['USUARIO_CODIGOPERFIL'];
  //$codigoPerfil         = 60;

	//$codigoUnidadUsuario  = $_SESSION['USUARIO_CODIGOUNIDAD'];
	//$codigoUnidadUsuario  = 2185;

  $anno  = $_POST['anno'];
  $mes   = $_POST['mes'];
  $codigoUnidadUsuario   = $_POST['unidad'];


  //$anno  = 2012;
  //$mes   = 5;


    $CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
		mysql_select_db(DB);

		$sql1 = "
SELECT 
  UNIDAD.UNI_DESCRIPCION

FROM
  UNIDAD

WHERE
UNIDAD.UNI_CODIGO='".$codigoUnidadUsuario."'
;";

    $descripcionUnidad="";
    
		$result1 = mysql_query($sql1,$CONECT1);

    if($myrow1 = mysql_fetch_array($result1));
    {
        $descripcionUnidad=$myrow1[UNI_DESCRIPCION];
    }
    
    

		$sql1 = "
SELECT 
  DAY(SERVICIOS_CERTIFICADO.FECHA_SERVICIOS) AS DIA,
  DATE_FORMAT(SERVICIOS_CERTIFICADO.FECHA_CERTIFICADO,'%d-%m-%Y') AS FECHA_CERTIFICADO_FORMATO,
  SERVICIOS_CERTIFICADO.HORA_CERTIFICADO HORA_CERTIFICADO,
  GRADO.GRA_DESCRIPCION,
  FUNCIONARIO.FUN_NOMBRE,
  FUNCIONARIO.FUN_APELLIDOPATERNO,
  FUNCIONARIO.FUN_APELLIDOMATERNO,
  FUNCIONARIO.FUN_CODIGO

FROM
  SERVICIOS_CERTIFICADO
  INNER JOIN FUNCIONARIO ON (SERVICIOS_CERTIFICADO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO AND FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)

WHERE
YEAR(SERVICIOS_CERTIFICADO.FECHA_SERVICIOS)='".$anno."' AND
MONTH(SERVICIOS_CERTIFICADO.FECHA_SERVICIOS)='".$mes."' AND
SERVICIOS_CERTIFICADO.UNI_CODIGO='".$codigoUnidadUsuario."'

ORDER BY 
  SERVICIOS_CERTIFICADO.FECHA_SERVICIOS ASC
  
;";

//echo $sql1;




		$result1 = mysql_query($sql1,$CONECT1);
 
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    echo "<root>";

    echo "<descripcionUnidad>".utf8_encode($descripcionUnidad)."</descripcionUnidad>";


    $cantDiasMes = date("d", mktime(0,0,0,$mes+1, 0, $anno));

    $i=1;


    while($i<=$cantDiasMes)
    {
        if($myrow1 = mysql_fetch_array($result1))
        {
            while($i<$myrow1[DIA])
            {
                echo "<certificado>";
                  echo "<fechaServicios>".date("d-m-Y",strtotime($anno."-".$mes."-".$i))."</fechaServicios>";
                  echo "<estado>SIN VALIDAR</estado>";
                  echo "<grado></grado>";
                  echo "<codigoFuncionario></codigoFuncionario>";
                  echo "<nombre></nombre>";
                  echo "<apellidoPaterno></apellidoPaterno>";
                  echo "<apellidoMaterno></apellidoMaterno>";
                  echo "<fechaCertificado></fechaCertificado>";
                  echo "<horaCertificado></horaCertificado>";
                echo "</certificado>";
                $i++;
            }
                echo "<certificado>";
                  echo "<fechaServicios>".date("d-m-Y",strtotime($anno."-".$mes."-".$i))."</fechaServicios>";
                  echo "<estado>VALIDADO</estado>";
                  echo "<grado>".$myrow1[GRA_DESCRIPCION]."</grado>";
                  echo "<codigoFuncionario>".$myrow1[FUN_CODIGO]."</codigoFuncionario>";
                  echo "<nombre>".utf8_encode($myrow1[FUN_NOMBRE])."</nombre>";
                  echo "<apellidoPaterno>".utf8_encode($myrow1[FUN_APELLIDOPATERNO])."</apellidoPaterno>";
                  echo "<apellidoMaterno>".utf8_encode($myrow1[FUN_APELLIDOMATERNO])."</apellidoMaterno>";
                  echo "<fechaCertificado>".utf8_encode($myrow1[FECHA_CERTIFICADO_FORMATO])."</fechaCertificado>";
                  echo "<horaCertificado>".utf8_encode($myrow1[HORA_CERTIFICADO])."</horaCertificado>";
                echo "</certificado>";
                $i++;
        }
        
        
        else
        {
            while($i<=$cantDiasMes)
            {
                echo "<certificado>";
                  echo "<fechaServicios>".date("d-m-Y",strtotime($anno."-".$mes."-".$i))."</fechaServicios>";
                  echo "<estado>SIN VALIDAR</estado>";
                  echo "<grado></grado>";
                  echo "<codigoFuncionario></codigoFuncionario>";
                  echo "<nombre></nombre>";
                  echo "<apellidoPaterno></apellidoPaterno>";
                  echo "<apellidoMaterno></apellidoMaterno>";
                  echo "<fechaCertificado></fechaCertificado>";
                  echo "<horaCertificado></horaCertificado>";
                echo "</certificado>";
                $i++;
            }
        }
    }
    echo "</root>";
?>