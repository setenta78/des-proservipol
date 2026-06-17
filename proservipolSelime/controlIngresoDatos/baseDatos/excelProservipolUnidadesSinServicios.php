<?
  session_start();
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition:attachment;  filename=\"INGRESO_SERVICIOS_PROSERVIPOL3.XLS\";");
	//header ('content-type: text/xml');
	include("./config1.inc.php");


  //$arregloUnidades  = explode(",",$_POST['arregloUnidades']);

  //$arregloUnidades  = str_replace(","," OR ",$_POST['arregloUnidades']);
  //$arregloUnidades  = str_replace(","," OR UNIDAD.UNI_CODIGO=",$_POST['arregloUnidades']);

  $hora  = $_POST['horaForm'];
  $mes   = $_POST['mesForm'];
  $anno  = $_POST['annoForm'];

  $arregloUnidades = unserialize(stripslashes($_POST['arregloUnidadesForm']));

  echo "<table border=1>";
/*
  echo "<tr>
  <th colspan=5>INFORME UNIDADES SIN INGRESO DE SERVICIOS PROSERVIPOL V3.0</th>
  </tr>";
*/


  echo "<tr>
  <th colspan=4>INFORME UNIDADES/DESTACAMENTOS SIN INGRESO DE SERVICIOS PROSERVIPOL V3.0</th>
  </tr>";


  echo "<tr>
  <th colspan=4>FECHA INFORME : $hora</th>
  </tr>";
/*

  echo "<tr>
  <th colspan=5>FECHA INFORME : $hora</th>
  </tr>";


  echo "<tr>
  <th>FECHA</th>
  <th>ZONA</th>
  <th>PREFECTURA</th>
  <th>COMISARIA</th>
  <th>UNIDAD</th>
  </tr>";*/

  echo "<tr>
  <th>FECHA</th>
  <th>ZONA</th>
  <th>PREFECTURA</th>
  <th>UNIDAD/DESTACAMENTO</th>
  </tr>";


 for($i = 0, $size = sizeof($arregloUnidades); $i < $size; $i=$i+1)
 {

     $fecha = ($i+1)."-".$mes."-".$anno;
     
     $consulta = "";


     for($j = 0, $size2 = sizeof($arregloUnidades[$i]); $j < $size2; $j=$j+1)
     {
        if($j == 0)
        {
          $consulta = $arregloUnidades[$i][$j];
        }

        else
        {
          $consulta .= " OR UNIDAD.UNI_CODIGO=".$arregloUnidades[$i][$j];
        }
     }


     if($consulta != "")
     {

		$sql1 = "
SELECT
IF
((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL AND UNIPADRE2.UNI_DESCRIPCION IS NULL AND UNIPADRE.UNI_DESCRIPCION IS NULL),
'',
IF
	((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL AND UNIPADRE2.UNI_DESCRIPCION IS NULL),
    UNIDAD.UNI_DESCRIPCION,
    IF
    	((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL),
        UNIPADRE.UNI_DESCRIPCION,
	    IF
    		((UNIPADRE4.UNI_DESCRIPCION IS NULL),
        	UNIPADRE2.UNI_DESCRIPCION,
            UNIPADRE3.UNI_DESCRIPCION
        	)
        )
    )
) AS ZONA,

IF
((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL AND UNIPADRE2.UNI_DESCRIPCION IS NULL AND UNIPADRE.UNI_DESCRIPCION IS NULL),
'',
IF
	((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL AND UNIPADRE2.UNI_DESCRIPCION IS NULL),
    '',
    IF
    	((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL),
        UNIDAD.UNI_DESCRIPCION,
	    IF
    		((UNIPADRE4.UNI_DESCRIPCION IS NULL),
        	UNIPADRE.UNI_DESCRIPCION,
            UNIPADRE2.UNI_DESCRIPCION
        	)
        )
    )
) AS PREFECTURA,

IF
((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL AND UNIPADRE2.UNI_DESCRIPCION IS NULL AND UNIPADRE.UNI_DESCRIPCION IS NULL),
'',
IF
	((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL AND UNIPADRE2.UNI_DESCRIPCION IS NULL),
    '',
    IF
    	((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL),
        '',
	    IF
    		((UNIPADRE4.UNI_DESCRIPCION IS NULL),
        	UNIDAD.UNI_DESCRIPCION,
            UNIPADRE.UNI_DESCRIPCION
        	)
        )
    )
) AS COMISARIA,

IF
((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL AND UNIPADRE2.UNI_DESCRIPCION IS NULL AND UNIPADRE.UNI_DESCRIPCION IS NULL),
'',
IF
	((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL AND UNIPADRE2.UNI_DESCRIPCION IS NULL),
    '',
    IF
    	((UNIPADRE4.UNI_DESCRIPCION IS NULL AND UNIPADRE3.UNI_DESCRIPCION IS NULL),
        '',
	    IF
    		((UNIPADRE4.UNI_DESCRIPCION IS NULL),
        	UNIDAD.UNI_DESCRIPCION,
            UNIDAD.UNI_DESCRIPCION
        	)
        )
    )
) AS DESTACAMENTO

FROM UNIDAD

LEFT JOIN UNIDAD AS UNIPADRE ON
(UNIPADRE.UNI_CODIGO=UNIDAD.UNI_PADRE)

LEFT JOIN UNIDAD AS UNIPADRE2 ON
(UNIPADRE2.UNI_CODIGO=UNIPADRE.UNI_PADRE)

LEFT JOIN UNIDAD AS UNIPADRE3 ON
(UNIPADRE3.UNI_CODIGO=UNIPADRE2.UNI_PADRE)

LEFT JOIN UNIDAD AS UNIPADRE4 ON
(UNIPADRE4.UNI_CODIGO=UNIPADRE3.UNI_PADRE)


WHERE UNIDAD.UNI_CODIGO = ".$consulta."

ORDER BY
ZONA ASC,
PREFECTURA ASC,
COMISARIA ASC,
DESTACAMENTO ASC";


    $CONECT1 = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
		mysql_select_db(DB_DB_1);


		$result1 = mysql_query($sql1,$CONECT1);
 
    while($myrow1 = mysql_fetch_array($result1))
    {
        echo "<tr>";
          echo "<td>".$fecha."</td>";
          echo "<td>".utf8_encode($myrow1[ZONA])."</td>";
          echo "<td>".utf8_encode($myrow1[PREFECTURA])."</td>";
          //echo "<td>".utf8_encode($myrow1[COMISARIA])."</td>";
          echo "<td>".utf8_encode($myrow1[DESTACAMENTO])."</td>";
        echo "</tr>";
    }

     }
 }
  
 echo "</table>"; 
?>









