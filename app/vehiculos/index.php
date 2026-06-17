<?php
session_start(); // Asegúrate de que la sesión esté iniciada
include("../class/class.php"); // Incluir la clase de conexión

date_default_timezone_set('America/Santiago');  

if (isset($_SESSION["session_video_14"])) {
    $codigo = $_SESSION["session_video_14"];
    $grado  = $_SESSION["session_video_15"];
    $nombre = $_SESSION["session_video_16"];
    $tipo = $_SESSION["session_video_17"];

    $datos  = "($grado) - $nombre";
    $fecha = date("d/m/Y");

    // Obtener la fecha y hora actual en formato de 24 horas
    $miFechax = date('d-m-Y H:i:s', time());

    // Conectar a la base de datos utilizando la clase Conectar
    $con = Conectar::con(); // Aquí se usa la clase Conectar para obtener la conexión
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>APLICATIVOS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/estilos.css" type="text/css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php include '../header.php';?>

    <!-- Contenedor superior con la fecha y hora -->
    <div class="header-info">
        <div class="user-info">
            <?php 
                echo "<b>" . " &nbsp;&nbsp;&nbsp;Bienvenid@" . "</b>" . ": " . $datos;
                echo "<br>";
                echo "&nbsp;&nbsp;&nbsp; VOLVER <a href='http://des-proservipol.carabineros.cl/app/aplicativos.php'><img src='../img/icono_volver.jpg' border='0' width='30' align='middle' alt='Salir'/></a>";
                echo "<br>";
            ?>
        </div>
    </div>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-16">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Últimos 30 Vehículos Ingresados a la BD</h2>
                        <a href="create.php" class="btn btn-success pull-right">Agregar Nuevo Vehículo</a>
                    </div>
                    <?php
                    // Consultar los vehículos
						$sql = "SELECT 
							`VEHICULO`.`VEH_CODIGO`,
							`VEHICULO`.`TVEH_CODIGO`,
							`TIPO_VEHICULO`.`TVEH_DESCRIPCION`,
							`VEHICULO`.`PREC_CODIGO`,
							`PROCEDENCIA_RECURSO`.`PREC_DESCRIPCION`,
							`VEHICULO`.`VEH_BCU`,
							`VEHICULO`.`VEH_SAP`,
							`VEHICULO`.`MODVEH_CODIGO`,
							`MODELO_VEHICULO`.`MODVEH_DESCRIPCION`,
							`VEHICULO`.`MVEH_CODIGO`,
							`MARCA_VEHICULO`.`MVEH_DESCRIPCION`,
							`VEHICULO`.`VEH_PATENTE`,
							`VEHICULO`.`VEH_NUMEROINSITUCIONAL`,
							`VEHICULO`.`ANNO_FABRICACION`,
							`VEHICULO`.`UNI_CODIGO`,
							`UNIDAD`.`UNI_DESCRIPCION`
						FROM
							`VEHICULO`
							INNER JOIN `TIPO_VEHICULO` ON (`VEHICULO`.`TVEH_CODIGO` = `TIPO_VEHICULO`.`TVEH_CODIGO`)
							LEFT JOIN `MODELO_VEHICULO` ON (`VEHICULO`.`MODVEH_CODIGO` = `MODELO_VEHICULO`.`MODVEH_CODIGO`)
							LEFT JOIN `UNIDAD` ON (`VEHICULO`.`UNI_CODIGO` = `UNIDAD`.`UNI_CODIGO`)
							LEFT JOIN `MARCA_VEHICULO` ON (`MODELO_VEHICULO`.`MVEH_CODIGO` = `MARCA_VEHICULO`.`MVEH_CODIGO`)
							INNER JOIN `PROCEDENCIA_RECURSO` ON (`VEHICULO`.`PREC_CODIGO` = `PROCEDENCIA_RECURSO`.`PREC_CODIGO`)
						ORDER BY VEH_CODIGO DESC
						LIMIT 30";
							
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Código</th>";
                                        echo "<th>Tipo vehículo</th>";
										echo "<th>Procedencia</th>";	
                                        echo "<th>Cod. BCU</th>";
                                        echo "<th>Cod. SAP</th>";
                                        echo "<th>Marca</th>";
                                        echo "<th>Modelo</th>";
										echo "<th>Patente</th>";
										echo "<th>Nro. Instituional</th>";
										echo "<th>Año</th>";
										echo "<th>Unidad</th>";
                                        echo "<th>Acciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                // Este es el ciclo while que renderiza las filas de la tabla
									while ($row = mysqli_fetch_array($result)) {
									echo "<tr>";
										echo "<td>" . $row['VEH_CODIGO'] . "</td>";
										echo "<td>" . $row['TVEH_DESCRIPCION'] . "</td>";
										echo "<td>" . $row['PREC_DESCRIPCION'] . "</td>";
										echo "<td>" . $row['VEH_BCU'] . "</td>";
										echo "<td>" . $row['VEH_SAP'] . "</td>";
										echo "<td>" . $row['MVEH_DESCRIPCION'] . "</td>";
										echo "<td>" . $row['MODVEH_DESCRIPCION'] . "</td>";
										echo "<td>" . $row['VEH_PATENTE'] . "</td>";
										echo "<td>" . $row['VEH_NUMEROINSITUCIONAL'] . "</td>";
										echo "<td>" . $row['ANNO_FABRICACION'] . "</td>";
										echo "<td>" . $row['UNI_DESCRIPCION'] . "</td>";
										echo "<td>";
										echo "<a href='update.php?id=" . $row['VEH_CODIGO'] . "' title='Actualizar Registro' class='btn btn-info btn-sm'>Actualizar</a> ";
										echo "<a href='delete.php?id=" . $row['VEH_CODIGO'] . "' title='Eliminar Registro' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este registro?\")'>Eliminar</a>";
										echo "</td>";
									echo "</tr>";
}
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No existen registros.</em></p>";
                        }
                    } else{
                        echo "ERROR: No se pudo ejecutar la consulta $sql. " . mysqli_error($con);
                    }
 
                    // Close connection
                    mysqli_close($con);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
<?php
} else {
	echo "
	<script type='text/javascript'>
	alert('DEBE INICIAR SESI\u00D3N PARA ACCEDER A ESTE CONTENIDO');
	window.location='http://des-proservipol.carabineros.cl/app/';
	</script>";
}
?>



