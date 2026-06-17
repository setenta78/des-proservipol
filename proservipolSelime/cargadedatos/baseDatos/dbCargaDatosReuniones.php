<?
  session_start();
	include("./config3.inc.php");
	include("./config2.inc.php");


  $anno  = $_POST['anno'];
  $mes   = $_POST['mes'];


        $sql2 = "
        DELETE
        FROM
        BIC_RELAC_COMUN_FT_CARGA_REUN
        WHERE BIC_RELAC_COMUN_FT_CARGA_REUN.ANNO=".$anno." AND BIC_RELAC_COMUN_FT_CARGA_REUN.MES=".$mes."
        ;";


        $CONECT2 = mssql_connect(DB_HOST_2,DB_USER_2,DB_PASS_2);
        mssql_select_db(DB_DB_2);


        $result2 = mssql_query($sql2,$CONECT2); 


		$sql1 = "
    SELECT
        '".$anno."' AS ANNO,
        '".$mes."' AS MES,
        REUNION.UNI_CODIGO AS UNI_CODIGO,
        REUNION.EST_CODIGO AS REST_CODIGO,
        COUNT(DISTINCT ORGANIZACION.ORG_CODIGO) AS CANT_ORGANIZACIONES,
        COUNT(DISTINCT PROBLEMAS.PRO_CORRELATIVO) AS CANT_PROBLEMAS,
        COUNT(DISTINCT COMPROMISO.COM_ID) AS CANT_COMPROMISOS

    FROM REUNION

    INNER JOIN ORGANIZACION_ASISTENTE ON
      (
          REUNION.UNI_CODIGO=ORGANIZACION_ASISTENTE.UNI_CODIGO AND
          REUNION.REU_ANNO=ORGANIZACION_ASISTENTE.REU_ANNO AND
          REUNION.REU_CORRELATIVO=ORGANIZACION_ASISTENTE.REU_CORRELATIVO
          AND MONTH(REUNION.REU_FECHA)='".$mes."'
          AND YEAR(REUNION.REU_FECHA)='".$anno."'
      )

    INNER JOIN ORGANIZACION ON
      (
          ORGANIZACION_ASISTENTE.ORG_CODIGO=ORGANIZACION.ORG_CODIGO
      )

    LEFT JOIN PROBLEMAS ON
      (
          REUNION.UNI_CODIGO=PROBLEMAS.UNI_CODIGO AND
          REUNION.REU_ANNO=PROBLEMAS.REU_ANNO AND
          REUNION.REU_CORRELATIVO=PROBLEMAS.REU_CORRELATIVO
      )

    LEFT JOIN COMPROMISO ON
      (
          PROBLEMAS.UNI_CODIGO=COMPROMISO.UNI_CODIGO AND
          PROBLEMAS.REU_ANNO=COMPROMISO.REU_ANNO AND
          PROBLEMAS.REU_CORRELATIVO=COMPROMISO.REU_CORRELATIVO AND
          PROBLEMAS.PRO_CORRELATIVO=COMPROMISO.PRO_CORRELATIVO
      )

    GROUP BY
      REUNION.UNI_CODIGO,
      REUNION.EST_CODIGO
  ";


    $CONECT1 = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
		mysql_select_db(DB_DB_1);


		$result1 = mysql_query($sql1,$CONECT1);


    $contador=0;


    while($myrow1 = mysql_fetch_array($result1))
    {
        $sql2 = "
        INSERT INTO
        BIC_RELAC_COMUN_FT_CARGA_REUN
        (
        ANNO,
        MES,
        UNI_CODIGO,
        REST_CODIGO,
        CANT_ORGANIZACIONES,
        CANT_PROBLEMAS,
        CANT_COMPROMISOS
        )
        VALUES
        (
        '".$myrow1[ANNO]."',
        '".$myrow1[MES]."',
        '".$myrow1[UNI_CODIGO]."',
        '".$myrow1[REST_CODIGO]."',
        '".$myrow1[CANT_ORGANIZACIONES]."',
        '".$myrow1[CANT_PROBLEMAS]."',
        '".$myrow1[CANT_COMPROMISOS]."'
        )";

        $result2 = mssql_query($sql2,$CONECT2);


    $contador=$contador+1;

    }

    echo "CARGA REUNIONES MES ".$mes."-".$anno." FINALIZADA.  TOTAL REGISTROS: ".$contador;


?>









