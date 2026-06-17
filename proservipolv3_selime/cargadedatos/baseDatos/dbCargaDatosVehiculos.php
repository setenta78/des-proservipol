<?
  session_start();
	include("./config1.inc.php");
	include("./config2.inc.php");


  $anno  = $_POST['anno'];
  $mes   = $_POST['mes'];
  $dia   = $_POST['dia'];


        $CONECT2 = mssql_connect(DB_HOST_2,DB_USER_2,DB_PASS_2);
        mssql_select_db(DB_DB_2);


  if($dia==01)
  {
        $sql2 = "
        DELETE
        FROM
        BIC_PROSERVIPOL_FT_VEHICULOS
        WHERE YEAR(BIC_PROSERVIPOL_FT_VEHICULOS.FECHA_CODIGO)=".$anno." AND MONTH(BIC_PROSERVIPOL_FT_VEHICULOS.FECHA_CODIGO)=".$mes."
        ;";

        $result2 = mssql_query($sql2,$CONECT2); 
  }


		$sql1 = "
    SELECT
        '".$dia."-".$mes."-".$anno."' AS FECHA_CODIGO,
        ESTADO_VEHICULO.UNI_CODIGO AS UNI_CODIGO,
        VEHICULO.TVEH_CODIGO AS TVEH_CODIGO,
        ESTADO_VEHICULO.EST_CODIGO AS EST_CODIGO,
        COUNT(ESTADO_VEHICULO.UNI_CODIGO) AS VEH_CANTIDAD

    FROM
      ESTADO_VEHICULO

        INNER JOIN VEHICULO ON
        (
        ESTADO_VEHICULO.VEH_CODIGO=VEHICULO.VEH_CODIGO
        )

    WHERE
        (
        (
          ESTADO_VEHICULO.FECHA_DESDE <= '".$anno."-".$mes."-".$dia."' AND
          ESTADO_VEHICULO.FECHA_HASTA > '".$anno."-".$mes."-".$dia."'
        )
        OR
        (
          ESTADO_VEHICULO.FECHA_DESDE <= '".$anno."-".$mes."-".$dia."' AND
          ESTADO_VEHICULO.FECHA_HASTA IS NULL
        )
        )

        AND ESTADO_VEHICULO.UNI_CODIGO IS NOT NULL

        GROUP BY
        ESTADO_VEHICULO.UNI_CODIGO,
        VEHICULO.TVEH_CODIGO,
        ESTADO_VEHICULO.EST_CODIGO
    ";


    $CONECT1 = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
		mysql_select_db(DB_DB_1);


		$result1 = mysql_query($sql1,$CONECT1);


    $contador=0;


    while($myrow1 = mysql_fetch_array($result1))
    {

        $sql2 = "
        INSERT INTO
        BIC_PROSERVIPOL_FT_VEHICULOS
        (
        FECHA_CODIGO,
        UNI_CODIGO,
        TVEH_CODIGO,
        EST_CODIGO,
        VEH_CANTIDAD
        )
        VALUES
        (
        '".$myrow1[FECHA_CODIGO]."',
        '".$myrow1[UNI_CODIGO]."',
        '".$myrow1[TVEH_CODIGO]."',
        '".$myrow1[EST_CODIGO]."',
        '".$myrow1[VEH_CANTIDAD]."'
        )";


        $result2 = mssql_query($sql2,$CONECT2);


    $contador=$contador+1;

    }

    echo "CARGA VEHICULOS DIA ".$dia."-".$mes."-".$anno." FINALIZADA.  TOTAL REGISTROS: ".$contador;
        
    //echo "CARGA PERSONAL FINALIZADA.  TOTAL REGISTROS: ";
?>









