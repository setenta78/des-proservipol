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
        BIC_PROSERVIPOL_FT_PERSONAL
        WHERE YEAR(BIC_PROSERVIPOL_FT_PERSONAL.FECHA_CODIGO)=".$anno." AND MONTH(BIC_PROSERVIPOL_FT_PERSONAL.FECHA_CODIGO)=".$mes."
        ;";

        $result2 = mssql_query($sql2,$CONECT2); 
  }


		$sql1 = "
    SELECT
        '".$dia."-".$mes."-".$anno."' AS FECHA_CODIGO,
        FUNCIONARIO.ESC_CODIGO AS ESC_CODIGO,
        FUNCIONARIO.GRA_CODIGO AS GR_CODIGO,
        CARGO_FUNCIONARIO.UNI_CODIGO AS UNI_CODIGO,
        CARGO_FUNCIONARIO.CAR_CODIGO AS CAR_CODIGO,
        CASE WHEN (CARGO_FUNCIONARIO.CUADRANTE_CODIGO IS NULL) THEN 0
        ELSE CARGO_FUNCIONARIO.CUADRANTE_CODIGO
        END AS UCUAD_CODIGO,
        COUNT(CARGO_FUNCIONARIO.UNI_CODIGO) AS PER_CANTIDAD

    FROM
      CARGO_FUNCIONARIO

        INNER JOIN FUNCIONARIO ON
        (
        CARGO_FUNCIONARIO.FUN_CODIGO=FUNCIONARIO.FUN_CODIGO
        )

    WHERE
        (
        (
          CARGO_FUNCIONARIO.FECHA_DESDE <= '".$anno."-".$mes."-".$dia."' AND
          CARGO_FUNCIONARIO.FECHA_HASTA > '".$anno."-".$mes."-".$dia."'
        )
        OR
        (
           CARGO_FUNCIONARIO.FECHA_DESDE <= '".$anno."-".$mes."-".$dia."' AND
           CARGO_FUNCIONARIO.FECHA_HASTA IS NULL
        )
        )

        GROUP BY
        FUNCIONARIO.ESC_CODIGO,
        FUNCIONARIO.GRA_CODIGO,
        CARGO_FUNCIONARIO.UNI_CODIGO,
        CARGO_FUNCIONARIO.CAR_CODIGO,
        CARGO_FUNCIONARIO.CUADRANTE_CODIGO
  ";


    $CONECT1 = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
		mysql_select_db(DB_DB_1);


		$result1 = mysql_query($sql1,$CONECT1);


    $contador=0;


    while($myrow1 = mysql_fetch_array($result1))
    {

        $sql2 = "
        INSERT INTO
        BIC_PROSERVIPOL_FT_PERSONAL
        (
        FECHA_CODIGO,
        ESC_CODIGO,
        GR_CODIGO,
        UNI_CODIGO,
        CAR_CODIGO,
        UCUAD_CODIGO,
        PER_CANTIDAD
        )
        VALUES
        (
        '".$myrow1[FECHA_CODIGO]."',
        '".$myrow1[ESC_CODIGO]."',
        '".$myrow1[GR_CODIGO]."',
        '".$myrow1[UNI_CODIGO]."',
        '".$myrow1[CAR_CODIGO]."',
        '".$myrow1[UCUAD_CODIGO]."',
        '".$myrow1[PER_CANTIDAD]."'
        )";


        $result2 = mssql_query($sql2,$CONECT2);


    $contador=$contador+1;

    }

    echo "CARGA PERSONAL DIA ".$dia."-".$mes."-".$anno." FINALIZADA.  TOTAL REGISTROS: ".$contador;
        
    //echo "CARGA PERSONAL FINALIZADA.  TOTAL REGISTROS: ";
?>









