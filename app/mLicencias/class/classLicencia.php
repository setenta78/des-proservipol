<?php
require_once("class_conexion.php");

class Trabajo
{
	private $resultados;
	private $certificado;
	
	public function __construct()
	{
		$this->resultados=array();
		$this->certificado=array();
		$this->funcionario=array();
	}
	
	public function autocompletar()
	{
		if(isset($_POST["word"]))
		{
			//if($_POST["word"]{0}=="*")
			//{
				//$sql="SELECT *"
					//." FROM "
					//." VISTA_UNIDADES_2 "
					//." WHERE "
					//." DESTACAMENTO_DESCRIPCION LIKE '%".$_POST["word"]."%'ORDER BY DESTACAMENTO_DESCRIPCION ASC"; 
						$sql="SELECT *"
					." FROM "
					." UNIDAD "
					." WHERE "
					." UNI_TIPOUNIDAD NOT IN(10,15,20,30,40) AND"
					." UNI_SELECCIONABLE=1 AND"
					." UNI_DESCRIPCION LIKE '%".$_POST["word"]."%'ORDER BY UNI_DESCRIPCION ASC"; 
			//}
			$res=mysql_query($sql,Conectar::con());
			//echo $sql;
			while($row=mysql_fetch_array($res))
			{
			//$idUnidad=$row["DESTACAMENTO_CODIGO"];
			$idUnidad=$row["UNI_CODIGO"];
			//echo $dato2;
			//$dato=$row["DESTACAMENTO_DESCRIPCION"];
			$dato=$row["UNI_DESCRIPCION"];
				// Mostramos las lineas que se mostrarán en el desplegable. Cada enlace
				// tiene una funcion javascript que pasa los parámetros necesarios a la
				// función selectItem
				echo "<a href=\"javascript:selectItem('".$_POST["idContenido"]."','".$dato."','".$idUnidad."')\" title='$dato'>".$dato."</a><br>";
			}
		}
	}
	public function get_certificado()
    {
		
	//print_r($_POST);
        $sql="SELECT 
  LICENCIA_MEDICA.FOLIO_LICENCIA AS FOLIO,
  LICENCIA_MEDICA.FUN_RUT AS RUT,
  UNIDAD.UNI_DESCRIPCION AS UNIDAD_LICENCIA,
  LICENCIA_MEDICA.FECHA_INICIO_REAL AS FECHA_INICIO,
  LICENCIA_MEDICA.FECHA_TERMINO_REAL AS FECHA_TERMINO,
  DATEDIFF(LICENCIA_MEDICA.FECHA_TERMINO_REAL,LICENCIA_MEDICA.FECHA_INICIO_REAL)+1 AS DIAS,
  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS TIPO_LICENCIA,
  LICENCIA_MEDICA.FECHA_REGISTRO,  
  FUNCIONARIO.FUN_CODIGO AS CODIGO_FUNCIONARIO,
  GRADO.GRA_DESCRIPCION AS GRADO,
  CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
  IF(LICENCIA_MEDICA.ESTADO_LICENCIA=1,'mediumblue','crimson') COLOR_ESTADO,
  IF(LICENCIA_MEDICA.ESTADO_LICENCIA=1,'VIGENTE','ELIMINADA') ESTADO
FROM
  LICENCIA_MEDICA
  INNER JOIN UNIDAD ON (LICENCIA_MEDICA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
  INNER JOIN TIPO_SERVICIO ON (LICENCIA_MEDICA.TIPO_LICENCIA_MEDICA = TIPO_SERVICIO.TSERV_CODIGO)
  INNER JOIN FUNCIONARIO ON (LICENCIA_MEDICA.FUN_RUT = FUNCIONARIO.FUN_RUT)
  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
  AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
WHERE
  LICENCIA_MEDICA.FOLIO_LICENCIA ='".$_POST["texto2"]."'";
             $res=mysql_query($sql,Conectar::con());
 //echo $sql;
	// verificamos que no haya error 
       if (mysql_num_rows($res)==0){
       //echo "<script type='text/javascript'>alert('Ingrese fechas a Desvalidar.');</script>";
	   
	   //echo "";
         
        exit();
	
		
       }else{
	     echo "<br>";
         echo "<table border='0' width='75%' cellspacing='1' cellpadding='1'>";
         echo "<tr class='lineaDatos2' align='center'>";
         echo "<td>N&#176;</td>";
         echo "<td>FOLIO LICENCIA</td>";
         echo "<td>RUT</td>";
         echo "<td>UNIDAD ORIGEN LICENCIA</td>";
         echo "<td>INICIO</td>";
         echo "<td>TERMINO</td>";
         echo "<td>DIAS</td>";
         echo "<td>TIPO DE LICENCIA</td>";
         echo "<td>FECHA DE REGISTRO</td>";
         echo "<td align='middle'>FUNCIONARIO</td>";
         echo "<td>GRADO</td>";
         echo "<td align='middle'>NOMBRE COMPLETO</td>";
         echo "<td align='middle'>ESTADO LICENCIA</td>";
         echo "</tr>";
		 $rowColors = Array('#D9E6D9','#F2F2F2'); $nRow = 0; 
    //obtenemos los datos resultado de la consulta 
        while ($row = mysql_fetch_array($res)){
	    $i++;
	    $this->certificado[]=$row;
        echo "<tr id='marca' style='background-color:".$rowColors[$nRow++ % count($rowColors)].";' align='center' class='lineaDatos1'>"; 		
        echo "<td>".$i."</td>";
        echo "<td>".$row["FOLIO"]."</td>";
        echo "<td>".$row["RUT"]."</td>";
        echo "<td>".$row["UNIDAD_LICENCIA"]."</td>";
        echo "<td>".$row["FECHA_INICIO"]."</td>";
        echo "<td>".$row["FECHA_TERMINO"]."</td>";
        echo "<td>".$row["DIAS"]."</td>";
        echo "<td>".$row["TIPO_LICENCIA"]."</td>";
        echo "<td>".$row["FECHA_REGISTRO"]."</td>";
        echo "<td>".$row["CODIGO_FUNCIONARIO"]."</td>";
        echo "<td>".$row["GRADO"]."</td>";
        echo "<td>".$row["NOMBRE_COMPLETO"]."</td>";
		echo "<td style='color: ".$row["COLOR_ESTADO"].";'>".$row["ESTADO"]."</td>";
		echo "</tr>";
	    }  
	    echo "</table>";
		echo "<br>";
	   return $this->certificado;
      }			
}
  
   public function desvalidar() 
  {
        if(is_array($_POST["desv"])) //formo arreglo
        {
		$cuenta=count($_POST["desv"]);
		if($cuenta>1){
		$msj=$cuenta." DIAS HAN SIDO DESVALIDADOS.";
		}else{
		$msj=$cuenta." DIA HA SIDO DESVALIDADO.";
		}
        foreach($_POST["desv"] as $desvalidar){
		$sql="DELETE FROM SERVICIOS_CERTIFICADO WHERE FECHA_SERVICIOS='$desvalidar' AND UNI_CODIGO=".$_POST["unidad"]."";
		//echo "<meta http-equiv=Refresh content=\"0 ; url=index.php?desv=ok\">";
		//echo '<script type="text/javascript">alert("Desvalidado correctamente.");window.location="index.php";</script>';
		//echo $sql."<br>";
		$res=mysql_query($sql,Conectar::con());
	
		if(!$res){
		echo '<script type="text/javascript">alert("ERROR AL DESVALIDAR.");window.location="index.php";</script>';
		exit();
		}else{
		echo $numRows;
		echo '<script type="text/javascript">alert("DESVALIDADO CORRECTAMENTE,\n' .$msj.' ");window.location="index.php";</script>';
		}
       } 
      }              
  }

public function get_funcionario()
    {
		
	//print_r($_POST);
        $sql="SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  FUNCIONARIO.ESC_CODIGO,
				  FUNCIONARIO.GRA_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  CONCAT_WS(' ',FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2,FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO) AS FUNCIONARIO,
				  UNIDAD.UNI_DESCRIPCION,
				  CARGO.CAR_CODIGO,
				  CARGO.CAR_DESCRIPCION,
				  CARGO_FUNCIONARIO.CORRELATIVO_CARGOFUNCIONARIO,
				  CARGO_FUNCIONARIO.FECHA_DESDE,
				  CARGO_FUNCIONARIO.FECHA_HASTA,
				  CARGO_FUNCIONARIO.CUADRANTE_CODIGO,
				  CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_AGREGADO,
  				  UNIDAD1.UNI_DESCRIPCION AS DES_AGREGADO
				FROM
				  GRADO
				  INNER JOIN FUNCIONARIO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				  LEFT OUTER JOIN UNIDAD ON (FUNCIONARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				  LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				  LEFT OUTER JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				  LEFT OUTER JOIN UNIDAD UNIDAD1 ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD1.UNI_CODIGO)
			WHERE 
            CARGO_FUNCIONARIO.CORRELATIVO_CARGOFUNCIONARIO=(SELECT MAX(CORRELATIVO_CARGOFUNCIONARIO) FROM CARGO_FUNCIONARIO WHERE CARGO_FUNCIONARIO.FUN_CODIGO = '".$_POST["func"]."')
            AND FUNCIONARIO.FUN_CODIGO='".$_POST["func"]."'";
             $res=mysql_query($sql,Conectar::con());

	// verificamos que no haya error 
       if (! $res){
       echo "<script type='text/javascript'>alert('Ingrese fechas a Desvalidar.');</script>";
	   //echo "Ingrese busqueda";
	   
	   
        exit();
	
		
       }else{
	     echo "<br>";
         echo "<table border='1'>";
         echo "<tr>";
         echo "<td align='center'><img src='http://fototipcar.carabineros.cl/fototipcar/".$_POST["func"].".jpg' alt='".$_POST["func"]."' height='90' width='88'></td>";
         echo "</tr>";
		  
         //echo "<tr>";
    //obtenemos los datos resultado de la consulta 
        while ($row = mysql_fetch_array($res)){
	    $this->funcionario[]=$row;	
        $car=$row["CAR_CODIGO"];
		$cargo=$row["CAR_DESCRIPCION"];
		$fecha1=$row["FECHA_DESDE"];
		$fecha2=$row["FECHA_HASTA"];
		$uni=$row["UNI_DESCRIPCION"];
		$agre=$row["DES_AGREGADO"];
		
		echo "<tr>";
		echo "<td>CODIGO:</td>";
		echo "<td>".$row["FUN_CODIGO"]."</td>";
        echo "</tr>";
	    echo "<tr>";
		echo "<td>GRADO:</td>";
		echo "<td>".$row["GRA_DESCRIPCION"]."</td>";
        echo "</tr>";
		echo "<tr>";
		echo "<td>NOMBRE:</td>";
		echo "<td>".$row["FUNCIONARIO"]."</td>";
        echo "</tr>";
		echo "<tr>";
		echo "<td>UNIDAD:</td>";
		if($car==3500){
		echo $uno="<td>SIN ASIGNAR</td>";
		}else{
		echo $uno="<td>".$uni."</td>";
		}
        echo "</tr>";
		echo "<tr>";
		echo "<td>CARGO:</td>";
		if($car==1000 || $car==2000){
		echo $uno="<td><font color='red'>".$cargo."</font></td>";
		}else{
		echo $uno="<td>".$cargo."</td>";
		}
        echo "</tr>";
		echo "<tr>";
		echo "<td>UNIDAD AGREGADO:</td>";
		echo "<td>".$row["DES_AGREGADO"]."</td>";
        echo "</tr>";
		echo "<tr>";
		echo "<td>FECHA ULTIMO MOVIMIENTO:</td>";
		if($car==1000 || $car==2000){
		echo $uno="<td>".$fecha2."</td>";
		}else{
		echo $uno="<td>".$fecha1."</td>";
		}
        echo "</tr>";
		
	    }  
	    echo "</table>";
		echo "<br>";
	   return $this->funcionario;
      }			
}  
 
}
?>