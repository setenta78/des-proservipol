<?php
session_start();
if ($_SESSION["session_autent_p2"] == "SI")
{?>
<?php
  ini_set("memory_limit","80M");
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition:attachment;  filename=\"TRASLADOS_SECOM_".date('d_m_Y').".XLS\";");
	include("./config1.inc.php");

  $fechaInforme = date("d-m-Y");

  $fichero = fopen('../archivos/personal.txt',r);

  if($fichero)
  {
      //echo "ARCHIVO ABIERTO CON EXITO<br><br>";

      $contenido=str_replace(";",",",chop(fread($fichero, filesize('../archivos/personal.txt'))));

      $arregloAuxiliar = explode("\r\n",$contenido);

      fclose($fichero);


      for($i=1;$i<count($arregloAuxiliar);$i++)
      {
          $arreglo[$i-1] = explode(",",$arregloAuxiliar[$i]);
      }


      $CONECT = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
      mysql_select_db(DB_DB_1);


      $sql="DELETE FROM SECOM_TRASLADOS;";
      $result = mysql_query($sql,$CONECT);

      $auxiliar = "";

      for($i=0;$i<count($arreglo)-1;$i++)
      {
          $auxiliar .= "('".$arreglo[$i][0]."','".$arreglo[$i][1]."','".$arreglo[$i][2]."','".substr($arreglo[$i][3],6,4)."-".substr($arreglo[$i][3],3,2)."-".substr($arreglo[$i][3],0,2)."'),";
      }
          $auxiliar .= "('".$arreglo[$i][0]."','".$arreglo[$i][1]."','".$arreglo[$i][2]."','".substr($arreglo[$i][3],6,4)."-".substr($arreglo[$i][3],3,2)."-".substr($arreglo[$i][3],0,2)."')";




$sql = "INSERT INTO SECOM_TRASLADOS (FUN_CODIGO,UNI_ORIGEN,UNI_DESTINO,FECHA_DESTINO) VALUES ".$auxiliar.";";

      $result = mysql_query($sql,$CONECT);


      $auxiliar = "";
      $sql = "";


      $cont = 0;

  echo "<table border=1>";
  echo "<tr><th colspan=4>INFORME TRASLADOS SECOM PROSERVIPOL V3.0 (".$fechaInforme.")</th></tr>";
  echo "</table>";

  echo "<table border=0>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "</table>";

  echo "<table border=1>";
  echo "<tr><th colspan=4>FUNCIONARIOS QUE NO EXISTEN EN PROSERVIPOL V.3.0</th></tr>";
  echo "<tr><th colspan=4>(ERROR CODIGO FUNCIONARIO)</th></tr>";

$sql="
SELECT SECOM_TRASLADOS.FUN_CODIGO
FROM SECOM_TRASLADOS
WHERE SECOM_TRASLADOS.FUN_CODIGO NOT IN
(
	SELECT FUNCIONARIO.FUN_CODIGO
	FROM FUNCIONARIO
)
ORDER BY SECOM_TRASLADOS.FUN_CODIGO ASC
;";

      $result = mysql_query($sql,$CONECT);

      while($myrow = mysql_fetch_array($result))
      {
          echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td></td><td colspan=2></td></tr>";
          $cont++;            
      }

      echo "<tr><th colspan=4>TOTAL : ".$cont."</th></tr>";

      $sql = "";
      $cont = 0;

  echo "</table>";
  
  
  echo "<table border=0>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "</table>";



  echo "<table border=1>";
  echo "<tr><th colspan=4>UNIDADES DE DESTINO QUE NO EXISTEN EN PROSERVIPOL V.3.0</th></tr>";
  echo "<tr><th colspan=4>(ERROR CODIGO UNIDAD DESTINO)</th></tr>";

$sql="
SELECT SECOM_TRASLADOS.FUN_CODIGO,SECOM_TRASLADOS.UNI_DESTINO
FROM SECOM_TRASLADOS
LEFT JOIN UNIDAD ON (SECOM_TRASLADOS.UNI_DESTINO=UNIDAD.UNI_CODIGO_SECOM)
WHERE UNIDAD.UNI_CODIGO_SECOM IS NULL
ORDER BY SECOM_TRASLADOS.UNI_DESTINO ASC,SECOM_TRASLADOS.FUN_CODIGO ASC
;";

      echo "<tr><th>FUN_CODIGO</th><th>UNI_DESTINO</th><th colspan=2>&nbsp;</th></tr>";            

      $result = mysql_query($sql,$CONECT);

      while($myrow = mysql_fetch_array($result))
      {
          echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td style=\"mso-number-format:'0';\">".$myrow["UNI_DESTINO"]."</td><td colspan=2>&nbsp;</td></tr>";
          $cont++;
      }

      echo "<tr><th colspan=4>TOTAL : ".$cont."</th></tr>";

      $sql = "";
      $cont = 0;


  echo "</table>";
  
  
  echo "<table border=0>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "</table>";



  echo "<table border=1>";

  echo "<tr><th colspan=4>COMPARACION UNIDADES DE DESTINO</th></tr>";


$sql="
SELECT SECOM_TRASLADOS.FUN_CODIGO,IF(UNIDAD.UNI_CODIGO=FUNCIONARIO.UNI_CODIGO,'TRASLADO OK',IF(SECOM_TRASLADOS.FECHA_DESTINO>DATE_SUB(CURDATE(),INTERVAL 2 MONTH),'EN EL PLAZO',SECOM_TRASLADOS.FECHA_DESTINO)) AS COMPARACION
FROM SECOM_TRASLADOS
INNER JOIN UNIDAD ON (SECOM_TRASLADOS.UNI_DESTINO=UNIDAD.UNI_CODIGO_SECOM)
INNER JOIN FUNCIONARIO ON (SECOM_TRASLADOS.FUN_CODIGO=FUNCIONARIO.FUN_CODIGO)
ORDER BY COMPARACION ASC,SECOM_TRASLADOS.FUN_CODIGO ASC
;";

      echo "<tr><th>FUN_CODIGO</th><th>ESTADO</th><th>FECHA_DESTINO</th><th>&nbsp;</th></tr>";            

      $result = mysql_query($sql,$CONECT);

      $cont1 = 0;
      $cont2 = 0;

      while($myrow = mysql_fetch_array($result))
      {
          
          if($myrow["COMPARACION"]=="EN EL PLAZO")
          {
            echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>".$myrow["COMPARACION"]."</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            $cont1++;
          }
          
          else if($myrow["COMPARACION"]=="TRASLADO OK")
          {
            echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>".$myrow["COMPARACION"]."</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            $cont2++;
          }
          
          else
          {
              if($cont!=0)
              {
                  echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>FUERA DE PLAZO</td><td>".$myrow["COMPARACION"]."</td><td>&nbsp;</td></tr>";
                  $auxiliar .= " AND SECOM_TRASLADOS.FUN_CODIGO!='".$myrow["FUN_CODIGO"]."'";
              }
              
              else
              {
                  echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>FUERA DE PLAZO</td><td>".$myrow["COMPARACION"]."</td><td>&nbsp;</td></tr>";
                  $auxiliar .= "SECOM_TRASLADOS.FUN_CODIGO!='".$myrow["FUN_CODIGO"]."'";
              }


              $cont++;

          }
      }

      echo "<tr><th colspan=4>TOTAL FUERA DE PLAZO: ".$cont."</th></tr>";
      echo "<tr><th colspan=4>TOTAL EN EL PLAZO: ".$cont1."</th></tr>";
      echo "<tr><th colspan=4>TOTAL TRASLADO OK: ".$cont2."</th></tr>";

      $sql = "";
      $cont = 0;
      
      $cont1 = 0;
      $cont2 = 0;



  echo "</table>";
  
  
  echo "<table border=0>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "</table>";



  echo "<table border=1>";

  echo "<tr><th colspan=4>FUNCIONARIOS CON TRASLADO OK AGREGADOS</th></tr>";


$sql="
SELECT SECOM_TRASLADOS.FUN_CODIGO,UNIDAD.UNI_DESCRIPCION,IF(UNIDAD2.UNI_DESCRIPCION IS NULL,'AGREGADO',UNIDAD2.UNI_DESCRIPCION) AS UNI_AGREGADO
FROM SECOM_TRASLADOS
INNER JOIN UNIDAD ON (SECOM_TRASLADOS.UNI_DESTINO=UNIDAD.UNI_CODIGO_SECOM)
INNER JOIN FUNCIONARIO ON (SECOM_TRASLADOS.FUN_CODIGO=FUNCIONARIO.FUN_CODIGO)
INNER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO=CARGO_FUNCIONARIO.FUN_CODIGO)
LEFT JOIN UNIDAD AS UNIDAD2 ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD2.UNI_CODIGO)

WHERE
    UNIDAD.UNI_CODIGO=FUNCIONARIO.UNI_CODIGO

    AND
    (
    (
      CARGO_FUNCIONARIO.FECHA_DESDE <= CURDATE() AND
      CARGO_FUNCIONARIO.FECHA_HASTA > CURDATE()
    )
    OR
    (
       CARGO_FUNCIONARIO.FECHA_DESDE <= CURDATE() AND
       CARGO_FUNCIONARIO.FECHA_HASTA IS NULL AND
       FUNCIONARIO.UNI_CODIGO IS NOT NULL AND
       FUNCIONARIO.UNI_CODIGO = CARGO_FUNCIONARIO.UNI_CODIGO
    )
    )
    
    AND CARGO_FUNCIONARIO.CAR_CODIGO = 3000

ORDER BY SECOM_TRASLADOS.FUN_CODIGO ASC
;";

      echo "<tr><th>FUN_CODIGO</th><th>UNI_DESTINO</th><th>UNI_AGREGADO</th><th>&nbsp;</th></tr>";


      $result = mysql_query($sql,$CONECT);

      while($myrow = mysql_fetch_array($result))
      {
          echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>".$myrow["UNI_DESCRIPCION"]."</td><td>".$myrow["UNI_AGREGADO"]."</td><td>&nbsp;</td></tr>";
          $cont++;
      }

      echo "<tr><th colspan=4>TOTAL : ".$cont."</th></tr>";

      $sql = "";
      $cont = 0;


  echo "</table>";

//CONSULTAS PARA UNIDAD DE ORIGEN



$sql="
DELETE
FROM SECOM_TRASLADOS
WHERE ".$auxiliar."
;";


      $result = mysql_query($sql,$CONECT);

      $auxiliar = "";
      $sql = "";


  
  
  echo "<table border=0>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "</table>";



  echo "<table border=1>";

  echo "<tr><th colspan=4>UNIDADES DE ORIGEN QUE NO EXISTEN EN PROSERVIPOL V.3.0</th></tr>";
  echo "<tr><th colspan=4>(ERROR CODIGO UNIDAD ORIGEN)</th></tr>";

$sql="
SELECT SECOM_TRASLADOS.FUN_CODIGO,SECOM_TRASLADOS.UNI_ORIGEN
FROM SECOM_TRASLADOS
LEFT JOIN UNIDAD ON (SECOM_TRASLADOS.UNI_ORIGEN=UNIDAD.UNI_CODIGO_SECOM)
WHERE UNIDAD.UNI_CODIGO_SECOM IS NULL
ORDER BY SECOM_TRASLADOS.UNI_ORIGEN ASC,SECOM_TRASLADOS.FUN_CODIGO ASC
;";

      echo "<tr><th>FUN_CODIGO</th><th>UNI_ORIGEN</th><th colspan=2>&nbsp;</th></tr>";

      $result = mysql_query($sql,$CONECT);

      while($myrow = mysql_fetch_array($result))
      {
          echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td style=\"mso-number-format:'0';\">".$myrow["UNI_ORIGEN"]."</td><td colspan=2>&nbsp;</td></tr>";
          $cont++;
      }

      echo "<tr><th colspan=4>TOTAL : ".$cont."</th></tr>";

      $sql = "";
      $cont = 0;



  echo "</table>";
  
  
  echo "<table border=0>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "</table>";



  echo "<table border=1>";

  echo "<tr><th colspan=4>COMPARACION UNIDADES DE ORIGEN</th></tr>";



$sql="
SELECT SECOM_TRASLADOS.FUN_CODIGO,IF(UNIDAD.UNI_CODIGO=FUNCIONARIO.UNI_CODIGO,'EN UNIDAD DE ORIGEN',IF(FUNCIONARIO.UNI_CODIGO IS NULL,'SIN UNIDAD ASIGNADA','EN OTRA UNIDAD')) AS COMPARACION,UNIDAD.UNI_DESCRIPCION AS NOMBRE_UNIDAD,UNIDAD2.UNI_DESCRIPCION AS NOMBRE_UNIDAD2
FROM SECOM_TRASLADOS
INNER JOIN UNIDAD ON (SECOM_TRASLADOS.UNI_ORIGEN=UNIDAD.UNI_CODIGO_SECOM)
INNER JOIN FUNCIONARIO ON (SECOM_TRASLADOS.FUN_CODIGO=FUNCIONARIO.FUN_CODIGO)
LEFT JOIN UNIDAD AS UNIDAD2 ON (FUNCIONARIO.UNI_CODIGO=UNIDAD2.UNI_CODIGO)
ORDER BY COMPARACION ASC,UNIDAD.UNI_DESCRIPCION ASC, SECOM_TRASLADOS.FUN_CODIGO ASC
;";

      echo "<tr><th>FUN_CODIGO</th><th>ESTADO</th><th>UNIDAD_ORIGEN</th><th>OTRA_UNIDAD</th></tr>";            

      $result = mysql_query($sql,$CONECT);

      $cont1 = 0;
      $cont2 = 0;

      while($myrow = mysql_fetch_array($result))
      {
         
          if($myrow["COMPARACION"]=="EN UNIDAD DE ORIGEN")
          {
            echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>".$myrow["COMPARACION"]."</td><td>".$myrow["NOMBRE_UNIDAD"]."</td><td>&nbsp;</td></tr>";
            $cont1++;
          }
          
          else if($myrow["COMPARACION"]=="SIN UNIDAD ASIGNADA")
          {
            echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>".$myrow["COMPARACION"]."</td><td>".$myrow["NOMBRE_UNIDAD"]."</td><td>&nbsp;</td></tr>";
            $cont2++;
          }
          
          else
          {
              echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>".$myrow["COMPARACION"]."</td><td>".$myrow["NOMBRE_UNIDAD"]."</td><td>".$myrow["NOMBRE_UNIDAD2"]."</td></tr>";
              $cont++;

          }
      }

      echo "<tr><th colspan=4>TOTAL EN UNIDAD DE ORIGEN: ".$cont1."</th></tr>";
      echo "<tr><th colspan=4>TOTAL SIN UNIDAD ASIGNADA: ".$cont2."</th></tr>";
      echo "<tr><th colspan=4>TOTAL EN OTRA UNIDAD: ".$cont."</th></tr>";

      $sql = "";
      $cont = 0;
      
      $cont1 = 0;
      $cont2 = 0;

  echo "</table>";
  
  
  echo "<table border=0>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "<tr><th colspan=4>&nbsp;</th></tr>";
  echo "</table>";



  echo "<table border=1>";

  echo "<tr><th colspan=4>FUNCIONARIOS EN UNIDAD DE ORIGEN AGREGADOS</th></tr>";


$sql="
SELECT SECOM_TRASLADOS.FUN_CODIGO,UNIDAD.UNI_DESCRIPCION,IF(UNIDAD2.UNI_DESCRIPCION IS NULL,'AGREGADO',UNIDAD2.UNI_DESCRIPCION) AS UNI_AGREGADO
FROM SECOM_TRASLADOS
INNER JOIN UNIDAD ON (SECOM_TRASLADOS.UNI_ORIGEN=UNIDAD.UNI_CODIGO_SECOM)
INNER JOIN FUNCIONARIO ON (SECOM_TRASLADOS.FUN_CODIGO=FUNCIONARIO.FUN_CODIGO)
INNER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO=CARGO_FUNCIONARIO.FUN_CODIGO)
LEFT JOIN UNIDAD AS UNIDAD2 ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD2.UNI_CODIGO)

WHERE
    UNIDAD.UNI_CODIGO=FUNCIONARIO.UNI_CODIGO

    AND
    (
    (
      CARGO_FUNCIONARIO.FECHA_DESDE <= CURDATE() AND
      CARGO_FUNCIONARIO.FECHA_HASTA > CURDATE()
    )
    OR
    (
       CARGO_FUNCIONARIO.FECHA_DESDE <= CURDATE() AND
       CARGO_FUNCIONARIO.FECHA_HASTA IS NULL AND
       FUNCIONARIO.UNI_CODIGO IS NOT NULL AND
       FUNCIONARIO.UNI_CODIGO = CARGO_FUNCIONARIO.UNI_CODIGO
    )
    )
    
    AND CARGO_FUNCIONARIO.CAR_CODIGO = 3000

ORDER BY SECOM_TRASLADOS.FUN_CODIGO ASC
;";

      echo "<tr><th>FUN_CODIGO</th><th>UNI_ORIGEN</th><th>UNI_AGREGADO</th><th>&nbsp;</th></tr>";


      $result = mysql_query($sql,$CONECT);

      while($myrow = mysql_fetch_array($result))
      {
          echo "<tr><td>".$myrow["FUN_CODIGO"]."</td><td>".$myrow["UNI_DESCRIPCION"]."</td><td>".$myrow["UNI_AGREGADO"]."</td><td>&nbsp;</td></tr>";
          $cont++;
      }

      echo "<tr><th colspan=4>TOTAL : ".$cont."</th></tr>";

      $sql = "";
      $cont = 0;





  echo "</table>";






mysql_close();


  }


  else
  {
      echo "ERROR.  NO SE HA PODIDO ABRIR EL FICHERO.<br><br>";
  }


?>

<?php
} else{ header("location: ../../index.php?ingreso=error2"); }
?>
