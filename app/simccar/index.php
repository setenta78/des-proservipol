<?php
include("../class/class.php");

//require_once("solicitudesDesarrollo/js/valida.php");

//Incluimos el archivo con la función o simplemente pegamos la función
//require('fechaTexto.php');
if (isset($_SESSION["session_video_14"])) {
	$codigo = $_SESSION["session_video_14"];
	$grado  = $_SESSION["session_video_15"];
	$nombre = $_SESSION["session_video_16"];

	$tipo = $_SESSION["session_video_17"];

	$datos  = "(" . $grado . ")" . " - " . $nombre;
	//echo $codigo." ".$user." ".$descripcion
	//La fecha que queremos pasar a castellano

	//$miFecha = date('l jS \of F Y h:i:s A'); // date("d-m-Y h:m:s");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mantenedor de Simccar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../css/estilos.css" type="text/css" />
    <style type="text/css">
        .wrapper{
            width: 850px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
		<div class="texto3">
			<?php
			$fecha = date("d/m/Y");
			echo "<table border='0'>";
			echo "<tr>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			echo "</table>";
			echo "<b>" . " &nbsp;&nbsp;&nbsp;Bienvenid@" . "</b>" . ": " . $datos;
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp; VOLVER <a href='http://proservipol.carabineros.cl/app/aplicativos.php'><img src='../img/icono_volver.jpg' border='0'  width='30' align='middle' alt='Salir'/></a>";
			echo "<br>";
			?>
		</div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Últimas Simccar Ingresadas a la BD</h2>
                        <a href="create.php" class="btn btn-success pull-right">Agregar Nueva Simccar</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT 
							  `SIMCCAR`.`SIM_CODIGO`,
							  `SIMCCAR`.`SIM_SERIE`,
							  `SIMCCAR`.`SIM_TARJETA`,
							  `SIMCCAR`.`SIM_IMEI`,
							  `SIMCCAR`.`MSIM_CODIGO`,
							  `SIMCCAR`.`MODSIM_CODIGO`,
							  `SIMCCAR`.`ANNO_FABRICACION`,
							  `UNIDAD`.`UNI_CODIGO`,
							  `UNIDAD`.`UNI_DESCRIPCION`
							FROM
							  `SIMCCAR`
							  LEFT JOIN `UNIDAD` ON (`SIMCCAR`.`UNI_CODIGO` = `UNIDAD`.`UNI_CODIGO`)
							ORDER BY
							  `SIM_CODIGO` DESC
							LIMIT 15";
							
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Código</th>";
                                        echo "<th>N° Serie</th>";
										echo "<th>Tarjeta</th>";
                                        echo "<th>IMEI</th>";
                                        echo "<th>Marca</th>";
                                        echo "<th>Modelo</th>";
                                        echo "<th>Año Fabricación</th>";
										echo "<th>Unidad a la que pertenece</th>";
                                        echo "<th>Acciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['SIM_CODIGO'] . "</td>";
                                        echo "<td>" . $row['SIM_SERIE'] . "</td>";
                                        echo "<td>" . $row['SIM_TARJETA'] . "</td>";
                                        echo "<td>" . $row['SIM_IMEI'] . "</td>";
                                        echo "<td>" . $row['MSIM_CODIGO'] . "</td>";
                                        echo "<td>" . $row['MODSIM_CODIGO'] . "</td>";
										echo "<td>" . $row['ANNO_FABRICACION'] . "</td>";
                                        echo "<td>" . $row['UNI_DESCRIPCION'] . "</td>";
                                        echo "<td>";
                                         //   echo "<a href='read.php?id=". $row['SIM_CODIGO'] ."' title='Ver Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                         //  echo "<a href='update.php?id=". $row['SIM_CODIGO'] ."' title='Actualizar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        //    echo "<a href='delete.php?id=". $row['SIM_CODIGO'] ."' title='Eliminar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
                        echo "ERROR: No se pudo ejecutar la consulta $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
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
	window.location='http://proservipol.carabineros.cl/app/';
	</script>
	";
}
?>