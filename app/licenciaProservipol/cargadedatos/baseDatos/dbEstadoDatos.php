<?
  session_start();
	include("./config2.inc.php");


  $anno  = $_POST['anno'];
  $mes   = $_POST['mes'];


        $CONECT2 = mssql_connect(DB_HOST_2,DB_USER_2,DB_PASS_2);
        mssql_select_db(DB_DB_2);


        $sql2 = "
        SELECT COUNT(*)
        FROM
        BIC_PROSERVIPOL_FT_SERVICIOS
        WHERE YEAR(BIC_PROSERVIPOL_FT_SERVICIOS.FECHA_CODIGO)=".$anno." AND MONTH(BIC_PROSERVIPOL_FT_SERVICIOS.FECHA_CODIGO)=".$mes."
        ;";

        $result2 = mssql_query($sql2,$CONECT2); 

        $myrow2 = mssql_fetch_array($result2);

        $estado = "</br></br>PROSERVIPOL - SERVICIOS -> TOTAL REGISTROS: ".$myrow2[0];




        $sql2 = "
        SELECT COUNT(*)
        FROM
        BIC_PROSERVIPOL_FT_PERSONAL
        WHERE YEAR(BIC_PROSERVIPOL_FT_PERSONAL.FECHA_CODIGO)=".$anno." AND MONTH(BIC_PROSERVIPOL_FT_PERSONAL.FECHA_CODIGO)=".$mes."
        ;";

        $result2 = mssql_query($sql2,$CONECT2); 

        $myrow2 = mssql_fetch_array($result2);

        $estado = $estado."</br></br>PROSERVIPOL - PERSONAL -> TOTAL REGISTROS: ".$myrow2[0];



        $sql2 = "
        SELECT COUNT(*)
        FROM
        BIC_PROSERVIPOL_FT_VEHICULOS
        WHERE YEAR(BIC_PROSERVIPOL_FT_VEHICULOS.FECHA_CODIGO)=".$anno." AND MONTH(BIC_PROSERVIPOL_FT_VEHICULOS.FECHA_CODIGO)=".$mes."
        ;";

        $result2 = mssql_query($sql2,$CONECT2); 

        $myrow2 = mssql_fetch_array($result2);

        $estado = $estado."</br></br>PROSERVIPOL - VEHICULOS -> TOTAL REGISTROS: ".$myrow2[0];



        $sql2 = "
        SELECT COUNT(*)
        FROM
        BIC_RELAC_COMUN_FT_CARGA_ORGS
        WHERE BIC_RELAC_COMUN_FT_CARGA_ORGS.ANNO=".$anno." AND BIC_RELAC_COMUN_FT_CARGA_ORGS.MES=".$mes."
        ;";

        $result2 = mssql_query($sql2,$CONECT2); 

        $myrow2 = mssql_fetch_array($result2);

        $estado = $estado."</br></br>RELACIONES COMUNITARIAS - ORGANIZACIONES -> TOTAL REGISTROS: ".$myrow2[0];



        $sql2 = "
        SELECT COUNT(*)
        FROM
        BIC_RELAC_COMUN_FT_CARGA_REUN
        WHERE BIC_RELAC_COMUN_FT_CARGA_REUN.ANNO=".$anno." AND BIC_RELAC_COMUN_FT_CARGA_REUN.MES=".$mes."
        ;";

        $result2 = mssql_query($sql2,$CONECT2); 

        $myrow2 = mssql_fetch_array($result2);

        $estado = $estado."</br></br>RELACIONES COMUNITARIAS - REUNIONES -> TOTAL REGISTROS: ".$myrow2[0];






        echo "</br><b>ESTADO DATOS MES ".$mes."-".$anno.":</b> ".$estado;
        //echo "CARGA REUNIONES MES ".$mes."-".$anno." FINALIZADA.  TOTAL REGISTROS: ".$contador;


?>









