<?php
	// incluimos el fichero de conexión
	require_once('dbcon.php');
	//include_once('dbcon.php');
	
	// extraemos la informacion de la tabla FUNCIONARIOS..
	$sql = "SELECT 
				FUNCIONARIO.FUN_CODIGO,
				FUNCIONARIO.FUN_RUT,
				FUNCIONARIO.ESC_CODIGO,
				FUNCIONARIO.GRA_CODIGO,
				FUNCIONARIO.UNI_CODIGO,
				FUNCIONARIO.FUN_APELLIDOPATERNO,
				FUNCIONARIO.FUN_APELLIDOMATERNO,
				FUNCIONARIO.FUN_NOMBRE,
				FUNCIONARIO.FUN_NOMBRE2
			FROM
				FUNCIONARIO 
			ORDER BY FUNCIONARIO.FUN_CODIGO DESC
			LIMIT 15";

	$query = $con->query($sql);
	//echo $query->num_rows;
	$row_cnt = $query->num_rows;

	if($row_cnt > 0){
		echo "holi";
	//if ($query->num_rows  > 0) {
		$output = "";
		$output .= "<table class='table table-hover table-striped'>
				<thead>
					<tr>
						<th>CODIGO</th>
						<th>RUT</th>
						<th>ESCALAFON</th>
						<th>GRADO</th>
						<th>UNIDAD</th>
						<th>PRIMER APELLIDO</th>
						<th>SEGUNDO APELLIDO</th>
						<th>NOMBRE</th>
						<th>NOMBRE2</th>
						<th>Editar</th>
						<th>Borrar</th>
					</tr>
				</thead>";
		while ($row = $query->fetch_assoc()) {
		$output .= "<tbody>
					<tr>
						<td>{$row['FUN_CODIGO']}</td>
						<td>{$row['FUN_RUT']}</td>
						<td>{$row['ESC_CODIGO']}</td>
						<td>{$row['GRA_CODIGO']}</td>
						<td>{$row['UNI_CODIGO']}</td>
						<td>{$row['FUN_APELLIDOPATERNO']}</td>
						<td>{$row['FUN_APELLIDOMATERNO']}</td>
						<td>{$row['FUN_NOMBRE']}</td>
						<td>{$row['FUN_NOMBRE2']}</td>
						<td><button class='btn btn-success btn-sm editar-btn' data-id='{$row['FUN_CODIGO']}' data-toggle='modal' data-target='#exampleModal'>Editar</button></td>
						<td><button class='btn btn-danger btn-sm borrar-btn' data-id='{$row['FUN_CODIGO']}'>Borrar</button></td>
					</tr>
			</tbody>";
		}
	$output .="</table>";
	echo $output;
	}else{
		echo "<h5>Ningún registro fue encontrado</h5>";
	}
	
?>
