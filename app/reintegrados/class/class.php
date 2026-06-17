<?php
require_once("class_conexion.php");

class Trabajo
{
	private $funcionario;
	
	public function __construct()
	{
		$this->funcionario=array();
	}
	
public function get_funcionario()
    {
		
	//print_r($_POST);
	
	
        $sql="SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  FUNCIONARIO.ESC_CODIGO,
				  FUNCIONARIO.GRA_CODIGO,
				  UCASE(GRADO.GRA_DESCRIPCION) AS GRADO,
				  CONCAT_WS(' ',FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2,FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO) AS FUNCIONARIO,
				  UNIDAD.UNI_DESCRIPCION,
				  CARGO.CAR_CODIGO,
				  CARGO.CAR_DESCRIPCION,
				  CARGO_FUNCIONARIO.CORRELATIVO_CARGOFUNCIONARIO,
				  DATE_FORMAT(CARGO_FUNCIONARIO.FECHA_DESDE, '%d-%m-%Y') AS FECHA1,
				  DATE_FORMAT(CARGO_FUNCIONARIO.FECHA_HASTA, '%d-%m-%Y') AS FECHA2,
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
            CARGO_FUNCIONARIO.CORRELATIVO_CARGOFUNCIONARIO=(SELECT MAX(CORRELATIVO_CARGOFUNCIONARIO) FROM CARGO_FUNCIONARIO WHERE CARGO_FUNCIONARIO.FUN_CODIGO = '".strip_tags($_POST["txtfun"])."')
            AND FUNCIONARIO.FUN_CODIGO='".strip_tags($_POST["txtfun"])."'";
             $res=mysql_query($sql,Conectar::con());

	// verificamos que no haya error 
       if (! $res){
       //echo "<script type='text/javascript'>alert('Ingrese fechas a Desvalidar.');</script>";
	    echo "";
        exit();	
       }else{
	     echo "<br>";
         echo "<table border='0' bgcolor='#D9E6D9'>";
         echo "<tr>";
		 echo "<td colspan='2' align='center'><b>Datos del Funcionario</b></td>";
		 echo "</tr>";
		 echo "<tr>";
		  if(!empty($_POST["txtfun"]) && mysql_num_rows($res)!=0){
	      echo "<td align='center'><img src='carabinero.png' alt='".$_POST["txtfun"]."' height='90' width='88'></td";
		 }else{
		  //echo "<td>Es un funcionario que no se encuentra registrado en el sistema Proservipol V3.</td>";
		 echo '<script type="text/javascript">alert("FUNCIONARIO: '.$_POST["txtfun"].' \nNO PERTENECE HA NINGUNA UNIDAD REGISTRADA EN NUESTROS SISTEMAS.");window.location="reintegrar.php";</script>';
		 exit;
		 }
		
		 echo "<td>&nbsp;</td>";
		 echo "</tr>";
         //echo "<tr>";
    //obtenemos los datos resultado de la consulta 
        while ($row = mysql_fetch_array($res)){
	    $this->funcionario[]=$row;	
        $car=$row["CAR_CODIGO"];
		$cargo=$row["CAR_DESCRIPCION"];
		$fecha1=$row["FECHA1"];
		$fecha2=$row["FECHA2"];
		$uni=$row["UNI_DESCRIPCION"];
		$agre=$row["DES_AGREGADO"];
		$cod=$row["UNI_CODIGO"];
		echo "<tr>";
		echo "<td>&nbsp;</td>";
		echo "<td>&nbsp;</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>C&oacute;digo de funcionario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
		echo "<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='7' value='".$row["FUN_CODIGO"]."' readonly='readonly'/>&nbsp;&nbsp</td>";
        echo "</tr>";
	    echo "<tr>";
		echo "<td>Grado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
		echo "<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='15' value='".$row["GRADO"]."' readonly='readonly'/>&nbsp;&nbsp</td>";
        echo "</tr>";
		echo "<tr>";
		echo "<td>Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
		echo "<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='44' value='".$row["FUNCIONARIO"]."' readonly='readonly'/>&nbsp;&nbsp</td>";
        echo "</tr>";
		echo "<tr>";
		echo "<td>Unidad actual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
		if($car==3500 || $uni==''){
		echo $uno="<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='40' value='SIN ASIGNAR' readonly='readonly'/>&nbsp;&nbsp</td>";
		}else{
		echo $uno="<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='40' value='".$uni."' readonly='readonly'/>&nbsp;&nbsp</td>";
		}
        echo "</tr>";
		echo "<tr>";
		echo "<td>Cargo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
		if($car==1000 || $car==2000){
		echo $uno="<td><input type='text' id='txtfunc' name='txtfunc' style='color:red;' class='campos' size='40' value='".$cargo."' readonly='readonly'/>&nbsp;&nbsp</td>";
		}else{
		echo $uno="<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='40' value='".$cargo."' readonly='readonly'/>&nbsp;&nbsp</td>";
		}
        echo "</tr>";
		echo "<tr>";
		echo "<td>Unidad agregado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
		if($agre!=''){
		echo "<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='40' value='".$row["DES_AGREGADO"]."' readonly='readonly'/>&nbsp;&nbsp</td>";
        }else{
		echo "<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='40' value='NO REGISTRA' readonly='readonly'/>&nbsp;&nbsp</td>";
		}
		echo "</tr>";
		echo "<tr>";
		echo "<td>Fecha &uacuteltimo movimiento&nbsp;:</td>";
		if($car==1000 && $fecha2!='' || $car==2000 && $fecha2!=''){
			echo $uno="<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='10' value='".$fecha2."' readonly='readonly'/>&nbsp;&nbsp</td>";
		}elseif($car==1000 && $fecha2=='' || $car==2000 && $fecha2==''){
			echo $uno="<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='10' value='".$fecha1."' readonly='readonly'/>&nbsp;&nbsp</td>";
		}elseif($car!=1000  || $car!=2000 ){
			echo $uno="<td><input type='text' id='txtfunc' name='txtfunc' class='campos' size='10' value='".$fecha1."' readonly='readonly'/>&nbsp;&nbsp</td>";
		}
 
		echo "<tr>";
		echo "<td>&nbsp;</td>";
		echo "<td>&nbsp;</td>";
		echo "</tr>";
	    }  
	    echo "</table>";
	    echo "<br>";
		echo "<form name='form1' method='post' action=''>";
	    echo "<input type='hidden' id='txtfunc' name='txtfunc' class='campos' size='10' value='".$_POST["txtfun"]."'/>";
	    if($car==1000 && $fecha2!='' || $car==2000 && $fecha2!=''){
			echo "<input type='submit' id='btn' value='REINTEGRAR' title='REINTEGRAR' onClick=\"return confirmar('&iquest;DESEA REALIZAR EL REINTEGRO?')\"/><input type='hidden' name='grabar2' value='no'>";
	   }elseif($car==1000 && $fecha2=='' || $car==2000 && $fecha2==''){
			echo "<input type='submit' id='btn' value='REINTEGRAR' disabled='true' title='REINTEGRAR' onClick=\"return confirmar('&iquest;DESEA REALIZAR EL REINTEGRO?')\"/><input type='hidden' name='grabar2' value='no'>";
	   }
	   echo "</form>";
	
		return $this->funcionario;
      }			
}  

		public function UpdateCargoFunc()
	{
		//print_r($_POST);exit;
		
			$query="UPDATE CARGO_FUNCIONARIO  "
				." SET FECHA_HASTA=NULL "
				." WHERE "
				." CARGO_FUNCIONARIO.FUN_CODIGO = '".strip_tags($_POST["txtfunc"])."' "
				." ORDER BY CORRELATIVO_CARGOFUNCIONARIO  DESC LIMIT 1 ";
			mysql_query($query,Conectar::con());
			//echo $query;
			//exit;
		
	}
	
		public function UpdateFunc()
	{
		//print_r($_POST);exit;
		
			$query="UPDATE FUNCIONARIO "
				." SET UNI_CODIGO=NULL "
				." WHERE "
				." FUNCIONARIO.FUN_CODIGO = '".strip_tags($_POST["txtfunc"])."'";
			mysql_query($query,Conectar::con());
			//echo $query;
			//exit;
		
	}

  	public function Reintegro() //Actualiza ambas tablas
    {
     	self::UpdateCargoFunc();
		self::UpdateFunc();	
		echo '<script type="text/javascript">alert("FUNCIONARIO: '.STRTOUPPER($_POST["txtfunc"]).' \nHA SIDO REINTEGRADO CORRECTAMENTE.");window.location="reintegrar.php";</script>';
		exit;
    }
}
?>