<?php
require_once("class_conexion_h.php");

class Trabajo2
{
	private $servicio;
	public function __construct()
	{
		$this->servicio=array();
	}
	
	public function formateo_rut2($rut_param){ 
     
        $parte4 = substr($rut_param, -1); // seria solo el numero verificador 
    $parte3 = substr($rut_param, -4,3); // la cuenta va de derecha a izq  
    $parte2 = substr($rut_param, -7,3);  
        $parte1 = substr($rut_param, 0,-7); //de esta manera toma todos los caracteres desde el 8 hacia la izq 

    return $parte1.".".$parte2.".".$parte3."-".$parte4; 

}
	
	public function get_servicio2_old($codigo, $fecha1, $fecha2)
    {
	//print_r($_POST);
          $sql="SELECT 
  FUNCIONARIO.FUN_RUT AS RUT,
  FUNCIONARIO.FUN_CODIGO AS CODIGO,
  GRADO.GRA_DESCRIPCION AS GRADO,
  CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
  DATE_FORMAT(SERVICIO.FECHA, '%d-%m-%Y') AS FECHA,
  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS SERVICIO_REALIZADO,
  SERVICIO.HORA_INICIO AS HRA_INICIO,
  SERVICIO.HORA_TERMINO AS HRA_TERMINO,
  UNIDAD.UNI_DESCRIPCION UNIDAD_SERVICIO
FROM
  SERVICIO
  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
  INNER JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
  AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
  LEFT OUTER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
WHERE
  FUNCIONARIO.FUN_CODIGO = '".$codigo."' AND SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."'
ORDER BY
  SERVICIO.FECHA";
             $res=mysql_query($sql,Conectar2::con2());
 //echo $sql;
	// verificamos que no haya error 
       if (mysql_num_rows($res)==0){
       	echo "<div class='texto3'>";
	      echo "C&Oacute;DIGO "."<b>".$codigo."</b>"." NO TIENE SERVICIOS ASOCIADOS";
	      echo "</div>";
	      //self::insert_busqueda($usuario);
        exit();
       }else{
         echo "<br>";
         echo "<table border='0' width='75%' cellspacing='1' cellpadding='1'>";
         echo "<tr>";
         echo "<td colspan='10' align='center'><a href=\"./reporteHistorico.php?cod=".$codigo."&f1=".$fecha1."&f2=".$fecha2."\" \"><img src='img/Excel-icon.png' border='0' align='middle' alt='Reporte'/></a></td>";
         echo "</tr>";
         echo "<tr class='lineaDatos2' align='center'>";
         echo "<td>Nro.</td>";
         echo "<td>RUT</td>";
         echo "<td>C&Oacute;DIGO</td>";
         echo "<td>GRADO</td>";
         echo "<td>NOMBRE</td>";
         echo "<td>FECHA</td>";
         echo "<td>SERVICIO REALIZADO</td>";
         echo "<td>HORA INICIO</td>";
         echo "<td>HORA TERMINO</td>";
         echo "<td align='middle'>UNIDAD DE SERVICIO</td>";
         echo "</tr>";
		 $rowColors = Array('#F1F1F1','#FFFFFF'); $nRow = 0; 
    //obtenemos los datos resultado de la consulta 
        while ($row = mysql_fetch_array($res)){
	    $i++;
	    $this->certificado[]=$row;
        echo "<tr id='marca' style='background-color:".$rowColors[$nRow++ % count($rowColors)].";' align='center' class='lineaDatos1'>"; 		
        echo "<td>".$i."</td>";
        echo "<td>".$this->formateo_rut2($row["RUT"])."</td>";
        echo "<td>".$row["CODIGO"]."</td>";
        echo "<td>".$row["GRADO"]."</td>";
        echo "<td>".$row["NOMBRE_COMPLETO"]."</td>";
        echo "<td>".$row["FECHA"]."</td>";
        echo "<td>".$row["SERVICIO_REALIZADO"]."</td>";
        echo "<td>".$row["HRA_INICIO"]."</td>";
        echo "<td>".$row["HRA_TERMINO"]."</td>";
        echo "<td>".$row["UNIDAD_SERVICIO"]."</td>";
        echo "</tr>";
	    }  
	    echo "</table>";
		 //self::insert_busqueda($usuario,$tipoUsuario,$unidad,$fecha,$ip,$dato1,$dato2,$dato3);
	   return $this->servicio;
      }			
}

public function get_servicio2($codigo, $fecha1, $fecha2)
    {
	//print_r($_POST);
          $sql="SELECT 
  VISTA_ARBOL_UNIDADES_NACIONAL.ZONA_DESCRIPCION AS ZONA,
  VISTA_ARBOL_UNIDADES_NACIONAL.PREFECTURA_DESCRIPCION AS PREFECTURA,
  VISTA_ARBOL_UNIDADES_NACIONAL.DEPENDIENTE_DESCRIPCION AS COMISARIA,
  VISTA_ARBOL_UNIDADES_NACIONAL.UNI_DESCRIPCION AS DESTACAMENTO,
  VISTA_ARBOL_UNIDADES_NACIONAL.UNI_CODIGO AS UNIDAD_PROSERVIPOL,
  FUNCIONARIO.FUN_CODIGO AS CODIGO,
  FUNCIONARIO.FUN_RUT AS RUT,
  GRADO.GRA_DESCRIPCION AS GRADO,
  CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
  SERVICIO.FECHA,
  SERVICIO.CORRELATIVO_SERVICIO AS ID_SERVICIO,
  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS SERVICIO_REALIZADO,
  TIPO_SERVICIO.TSERV_CODIGO AS TIPO_SERVICIO,
  SERVICIO.HORA_INICIO AS HRA_INICIO,
  SERVICIO.HORA_TERMINO AS HRA_TERMINO
FROM
  SERVICIO
  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
  INNER JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
  AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
  LEFT JOIN VISTA_ARBOL_UNIDADES_NACIONAL ON (SERVICIO.UNI_CODIGO = VISTA_ARBOL_UNIDADES_NACIONAL.UNI_CODIGO)
  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
WHERE
  FUNCIONARIO.FUN_CODIGO = '".$codigo."' AND SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."'
ORDER BY
  SERVICIO.FECHA";
             $res=mysql_query($sql,Conectar2::con2());
 //echo $sql;
	// verificamos que no haya error 
       if (mysql_num_rows($res)==0){
       	echo "<div class='texto3'>";
	      echo "C&Oacute;DIGO "."<b>".$codigo."</b>"." NO TIENE SERVICIOS ASOCIADOS";
	      echo "</div>";
	      //self::insert_busqueda($usuario);
        exit();
       }else{
         echo "<br>";
         echo "<table border='0' width='98%' cellspacing='1' cellpadding='1'>";
         echo "<tr>";
         echo "<td colspan='10' align='center'><a href=\"./reporteHistorico.php?cod=".$codigo."&f1=".$fecha1."&f2=".$fecha2."\" \"><img src='img/Excel-icon.png' border='0' align='middle' alt='Reporte'/></a></td>";
         echo "</tr>";
         echo "<tr class='lineaDatos2' align='center'>";
         echo "<td>Nro.</td>";
         echo "<td>ZONA</td>";
         echo "<td>PREFECTURA</td>";
         echo "<td>COMISARIA</td>";
         echo "<td>DESTACAMENTO</td>";
         echo "<td>C&Oacute;DIGO</td>";
         echo "<td>RUT</td>";
         echo "<td>GRADO</td>";
         echo "<td>NOMBRE</td>";
         echo "<td>FECHA</td>";
         echo "<td>ID SERVICIO</td>";
         echo "<td>SERVICIO REALIZADO</td>";
         echo "<td>ID TIPO SERVICIO</td>";
         echo "<td>HORA INICIO</td>";
         echo "<td>HORA TERMINO</td>";
         echo "</tr>";
		 $rowColors = Array('#F1F1F1','#FFFFFF'); $nRow = 0; 
    //obtenemos los datos resultado de la consulta 
        while ($row = mysql_fetch_array($res)){
	    $i++;
	    $this->certificado[]=$row;
        echo "<tr id='marca' style='background-color:".$rowColors[$nRow++ % count($rowColors)].";' align='center' class='lineaDatos1'>"; 		
        echo "<td>".$i."</td>";
        echo "<td>".$row["ZONA"]."</td>";
        echo "<td>".$row["PREFECTURA"]."</td>";
        echo "<td>".$row["COMISARIA"]."</td>";
        echo "<td>".$row["DESTACAMENTO"]."</td>";
        echo "<td>".$row["CODIGO"]."</td>";
        echo "<td>".$this->formateo_rut2($row["RUT"])."</td>";
        echo "<td>".$row["GRADO"]."</td>";
        echo "<td>".$row["NOMBRE_COMPLETO"]."</td>";
        echo "<td>".$row["FECHA"]."</td>";
        echo "<td>".$row["ID_SERVICIO"]."</td>";
        echo "<td>".$row["SERVICIO_REALIZADO"]."</td>";
        echo "<td>".$row["TIPO_SERVICIO"]."</td>";
        echo "<td>".$row["HRA_INICIO"]."</td>";
        echo "<td>".$row["HRA_TERMINO"]."</td>";
        echo "</tr>";
	    }  
	    echo "</table>";
		 //self::insert_busqueda($usuario,$tipoUsuario,$unidad,$fecha,$ip,$dato1,$dato2,$dato3);
	   return $this->servicio;
      }			
}

	public function login2()
	{
		$user=$_POST["rut_funcionario"];
		$pass=$_POST["clave_intranet"];
		//print_r($_POST);
		$sql="SELECT 
				  FUNCIONARIO.GRA_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  USUARIO.UNI_CODIGO,
				  USUARIO.US_LOGIN,
				  UNIDAD.UNI_DESCRIPCION,
          CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
				  USUARIO.TUS_CODIGO,
				  USUARIO.US_FECHACREACION,
				  TIPO_USUARIO.TUS_DESCRIPCION,
				  UNIDAD1.UNI_CODIGO AS COD_UNIDADPADRE,
					UNIDAD1.UNI_DESCRIPCION AS DES_UNIDADPADRE,
					UNIDAD.UNI_BLOQUEO,
					UNIDAD.UNI_TIPOUNIDAD
				FROM USUARIO
				  JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
				  JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
				  JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				  JOIN UNIDAD ON (USUARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				  LEFT JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
WHERE
   USUARIO.US_LOGIN = '".$user."' AND 
   USUARIO.US_PASSWORD= '".$pass."' AND USUARIO.TUS_CODIGO IN(90)";
		//echo $sql;
		$res=mysql_query($sql,Conectar2::con2());
		if (mysql_num_rows($res)==0)
		{
			echo "<script type='text/javascript'>
			alert('EL USUARIO Y LA CLAVE NO EXISTEN EN LA BASE DE DATOS ...');
			window.location='index.php';
			</script>";
		}else
		{
			//echo "si existen";
			if ($reg=mysql_fetch_array($res))
			{
				$_SESSION["session_video_14"]=$reg["US_LOGIN"];
				$_SESSION["session_video_15"]=$reg["GRA_DESCRIPCION"];
				$_SESSION["session_video_16"]=$reg["NOMBRE_COMPLETO"];
				$_SESSION["session_video_17"]=$reg["TUS_CODIGO"];
				//$_SESSION["session_video_17"]=$reg["REP_DESCRIPCION"];
				//$_SESSION["session_video_18"]=$reg["GRA_DESCRIPCION"];
				//$_SESSION["session_video_19"]=$reg["TUS_CODIGO"];
				//$_SESSION["session_video_20"]=$reg["REP_CODIGO"];
				
				header("Location: servicios.php");
			}
		}
	}
  
  public function insert_busqueda2($usuario,$tipoUsuario,$unidad,$fecha,$ip,$dato1,$dato2,$dato3)
	{
		
		$sql="INSERT INTO CONSULTA_SERVICIO
		      VALUES('".$usuario."',".$tipoUsuario.",".$unidad.",'".$fecha."','".$ip."','".$dato1."','".$dato2."','".$dato3."');";
		$result=mysql_query($sql,Conectar2::con2());
		//echo $sql;	
  } 
  
}
?>