<?php
	// incluimos fichero de conexión
	require_once('dbcon.php');

	if (isset($_POST['editarCodigo'])) {
		$editarCodigo = $_POST['editarCodigo'];
	}
	// extraer tabla clientes..
	
	$sql = "SELECT * FROM FUNCIONARIO WHERE FUN_CODIGO = {$editarCodigo}";
	$query = $con->query($sql);
	if ($query->num_rows > 0) {
		$output = "";
		while ($row = $query->fetch_assoc()) {
			/*
			$apaterno = strip_tags(trim($_POST["FUN_APELLIDOPATERNO"]));
			$amaterno = strip_tags(trim($_POST["FUN_APELLIDOMATERNO"]));
			$nombre = strip_tags(trim($_POST["FUN_NOMBRE"]));
			$nombre2 = strip_tags(trim($_POST["FUN_NOMBRE2"]));*/

	    $output .= "<form>
                      <div class='modal-body'>
                      	<input type='hidden' class='form-control' id='editarCodigo' value='{$row['FUN_CODIGO']}'>
                        <div class='form-group'>
						<label class='control-label' for='nombre'>Nombre:</label>
                            <input type='text' class='form-control' id='editarNombre' value='{$row['FUN_RUT']}'>
                        </div>
                        <div class='form-group'>
						<label class='control-label' for='email'>Email:</label>
                            <input type='text' class='form-control' id='editarEmail' value='{$row['ESC_CODIGO']}'>
                        </div>
						<div class='form-group'>
						<label class='control-label' for='pais'>Pais:</label>
                            <input type='text' class='form-control' id='editarPais' value='{$row['GRA_CODIGO']}'>
                        </div>
                        <div class='form-group'>
						<label class='control-label' for='pwd'>Password:</label>
                            <input type='text' class='form-control' id='editarPassword' value='{$row['UNI_CODIGO']}'>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        <button type='button' class='btn btn-info' id='editarSubmit'>Guardar cambios</button>
                      </div>
                  </form>";         	
	    }
	    $output .="</table>";
	}
	echo $output;

?>
