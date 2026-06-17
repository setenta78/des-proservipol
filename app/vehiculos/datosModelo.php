<?php
/*
// Include config file
require_once "config.php";

// Obtener el valor de la marca enviada por POST
$marca = isset($_POST['marca']) ? $_POST['marca'] : null;

if ($marca) {
	// Consulta segura para obtener los modelos basados en la marca seleccionada
	$sqlModelo = "SELECT 
                  `MODELO_VEHICULO`.`MODVEH_CODIGO`,
                  `MODELO_VEHICULO`.`MODVEH_DESCRIPCION`
                  FROM `MODELO_VEHICULO`
                  WHERE `MODELO_VEHICULO`.`MVEH_CODIGO` = ?
                  UNION ALL
                  SELECT 0 AS MODVEH_CODIGO, 'OTRO' AS MODVEH_DESCRIPCION
                  ORDER BY 2 ASC";

	if ($stmt = mysqli_prepare($link, $sqlModelo)) {
		// Asociar parámetros
		mysqli_stmt_bind_param($stmt, "i", $marca);

		// Ejecutar consulta
		mysqli_stmt_execute($stmt);

		// Obtener resultados
		$resultModelo = mysqli_stmt_get_result($stmt);

		// Crear la estructura del select
		$cadena = "<select id='modelo' name='modelo' class='form-control'>";

		// Verificar si hay resultados
		if (mysqli_num_rows($resultModelo) > 0) {
			while ($rowModelo = mysqli_fetch_array($resultModelo)) {
				$cadena .= "<option value='" . $rowModelo['MODVEH_CODIGO'] . "'>" . $rowModelo['MODVEH_DESCRIPCION'] . "</option>";
			}
		} else {
			// En caso de que no haya resultados
			$cadena .= "<option value='0'>No hay modelos disponibles</option>";
		}

		$cadena .= "</select>";

		// Devolver el select generado
		echo $cadena;

		// Cerrar declaración
		mysqli_stmt_close($stmt);
	} else {
		echo "Error en la consulta";
	}
} else {
	echo "No se ha seleccionado una marca";
}

// Cerrar conexión a la base de datos
mysqli_close($link);
*/


// Include config file
require_once "config.php";

$marca = $_POST['marca'];

//echo $marca;

if ($marca <> 'null') {
	$sqlModelo = "SELECT 
			  `MODELO_VEHICULO`.`MODVEH_CODIGO`,
			  `MODELO_VEHICULO`.`MODVEH_DESCRIPCION`,
			  `MODELO_VEHICULO`.`MVEH_CODIGO`
			FROM
			  `MODELO_VEHICULO`
			  WHERE `MODELO_VEHICULO`.`MVEH_CODIGO` = '$marca'
			 
			 union all
			 
			 select 0, 'OTRO', NULL
			 
			 ORDER BY 2 ASC";

	$resultModelo = mysqli_query($link, $sqlModelo);
} else {
	$sqlModelo = "SELECT 
			  `MODELO_VEHICULO`.`MODVEH_CODIGO`,
			  `MODELO_VEHICULO`.`MODVEH_DESCRIPCION`,
			  `MODELO_VEHICULO`.`MVEH_CODIGO`
			FROM
			  `MODELO_VEHICULO`
			  WHERE `MODELO_VEHICULO`.`MVEH_CODIGO` = '$marca'
			 ORDER BY `MODELO_VEHICULO`.`MODVEH_DESCRIPCION` ASC";
}

$cadena = "<select id='modelo' name='modelo' class='form-control'>";

while ($rowModelo = mysqli_fetch_array($resultModelo)) {
	$cadena = $cadena . '<option value=' . $rowModelo['MODVEH_CODIGO'] . ">" . $rowModelo['MODVEH_DESCRIPCION'] . " (" . $rowModelo['MODVEH_CODIGO'] . ')</option>';
}

echo  $cadena . "</select>";
