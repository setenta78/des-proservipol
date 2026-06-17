<?php
// Include config file
require_once "config.php";

$marca=$_POST['marca'];

//echo $marca;

if ($marca <> 'null'){
$sqlModelo = "SELECT 
				  `MODELO_ARMA`.`MODARM_CODIGO`,
				  `MODELO_ARMA`.`MARM_CODIGO`,
				  `MODELO_ARMA`.`MODARM_DESCRIPCION`
				FROM
				  `MODELO_ARMA`
			  WHERE `MODELO_ARMA`.`MARM_CODIGO` = '$marca'
			 
			 union all
			 
			 select 0, 'OTRO', NULL
			 
			 ORDER BY 2 ASC";
			 
$resultModelo = mysqli_query($link, $sqlModelo);
}else{
	$sqlModelo = "SELECT 
				  `MODELO_ARMA`.`MODARM_CODIGO`,
				  `MODELO_ARMA`.`MARM_CODIGO`,
				  `MODELO_ARMA`.`MODARM_DESCRIPCION`
				FROM
				  `MODELO_ARMA`
			  	WHERE `MODELO_ARMA`.`MARM_CODIGO` = '$marca'
			 	ORDER BY `MODELO_ARMA`.`MODARM_DESCRIPCION` ASC";
}

$cadena="<select id='modelo' name='modelo' class='form-control'>";

while ($rowModelo = mysqli_fetch_array($resultModelo)) 
{
	$cadena=$cadena.'<option value='.$rowModelo['MODARM_CODIGO']. ">" .$rowModelo['MODARM_DESCRIPCION']."  (".$rowModelo['MODARM_CODIGO'].')</option>';
}

echo  $cadena."</select>";
?>