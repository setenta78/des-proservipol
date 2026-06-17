<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$tipo = $bcu = $nombre = $unidad = $fecha  = $raza = $color = $pelaje = $sexo ="";
$tipo_err = $bcu_err = $nombre_err = $unidad_err = $fecha_err  = $raza_err = $color_err = $pelaje_err = $sexo_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
		  
	$input_tipo = trim($_POST["tipo"]);
	$tipo = $input_tipo;
    
    // Validate bcu
    $input_bcu = trim($_POST["bcu"]);
    if(empty($input_bcu)){
        $bcu_err = "Por favor ingrese el BCU.";     
    } else{
		//$serie_err = $input_serie; //borrar
        $bcu = $input_bcu;
    }
	
	// Validate nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese el nombre.";     
    } else{
		//$serie_err = $input_serie; //borrar
        $nombre = $input_nombre;
    }
	
	// Validate fecha
    $input_fecha = trim($_POST["fecha"]);
    if(empty($input_fecha)){
        $fecha_err = "Por favor ingrese la fecha.";     
    } else{
		//$serie_err = $input_serie; //borrar
        $fecha = $input_fecha;
    }
	
	// Validate raza
    $input_raza = trim($_POST["raza"]);
    if(empty($input_raza)){
        $raza_err = "Por favor ingrese la raza.";     
    } else{
		//$serie_err = $input_serie; //borrar
        $raza = $input_raza;
    }
		
	// Validate color
    $input_color = trim($_POST["color"]);
    if(empty($input_color)){
        $color_err = "Por favor ingrese el color.";     
    } else{
		//$serie_err = $input_serie; //borrar
        $color = $input_color;
    }
	
	// Validate pelaje
    $input_pelaje = trim($_POST["pelaje"]);
    if(empty($input_pelaje)){
        $pelaje_err = "Por favor ingrese el pelaje.";     
    } else{
		//$serie_err = $input_serie; //borrar
        $pelaje = $input_pelaje;
    }
	
	$input_sexo = trim($_POST["sexo"]);
	$sexo = $input_sexo;

	
	// Validate unidad
	 $input_unidadTemporal = substr($_POST["unidad"], -5); 
	 $input_unidad = intval(preg_replace('/[^0-9]+/', '', $input_unidadTemporal), 10);
	 if(empty($input_unidad)){
        $unidad_err = "Por favor ingrese la unidad del animal."; 
	}
	else{
        $unidad = $input_unidad;
		//$unidad_err = $unidad; //borra
    }
	

    // Check input errors before inserting in database //$tipo = $bcu = $nombre = $fecha  = $raza = $color = $pelaje = $sexo ="";
    if(empty($tipo_err) && empty($bcu_err) && empty($nombre_err) && empty($fecha_err) && empty($raza_err) && empty($color_err) && empty($pelaje_err) && empty($sexo_err)
	){
        // VALIDAMOS QUE NO EXISTA EL ANIMAL
		$sqlVerificacion = "SELECT * FROM ANIMAL WHERE CAB_BCU = '$bcu'";
							  
		$resultVerif = mysqli_query($link, $sqlVerificacion);
		$rowVerif = mysqli_fetch_array($resultVerif);	
		$existe = $rowVerif['CAB_BCU'];
		
		if(!empty($existe)){
		?>
			<script language="javascript"> 
                   alert ("El BCU ingresado ya existe en la BD favor verifique sus datos"); 
            </script> 
		<?
		 }
		else{
			// Prepare an insert statement
      		$sqlInsert = "INSERT INTO CABALLO (TANI_CODIGO, CAB_BCU, CAB_NOMBRE, UNI_CODIGO, FECHA_NAC, CAB_RAZA, CAB_COLOR, CAB_PELAJE, CAB_SEXO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
			//echo $sqlInsert;

			if($stmt = mysqli_prepare($link, $sqlInsert)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "sssssssss", $param_tipo, $param_bcu, $param_nombre, $param_unidad, $param_fecha, $param_raza, $param_color, $param_pelaje, $param_sexo); 
				 
				// Set parameters
				$param_tipo = $tipo;
				$param_bcu = $bcu;
				$param_nombre = $nombre;
				$param_unidad = $unidad;
				$param_fecha = $fecha;
				$param_raza = $raza;
				$param_color = $color;
				$param_pelaje = $pelaje;
				$param_sexo = $sexo;
			   
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Records created successfully. Redirect to landing page
					?>
						<script language="javascript"> 
                               alert ("Animal guardado satisfactoriamente en la BD."); 
							   window.location.href = 'index.php';
                        </script> 
                    <?
					
					exit();
				} else{
					echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
				}
			}
         }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
	
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ingreso Armamento</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(){
        
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("backend-search.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });
        
        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
    </script>
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Ingreso Animales Institucionales</h2>
                    </div>
                    <p>Complete este formulario y envíelo para agregar el registro de un nuevo animal a la base de datos de Proservipol.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formu">
                        <div class="form-group <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo (*)</label>
                                <select name="tipo" class="form-control" id="tipo">
                                  <option value="0">Seleccione</option>
                                  <option value="10">CABALLO</option>
                                  <option value="40">PERRO</option>
                                </select>      
                                <span class="help-block"><?php echo $tipo_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($bcu_err)) ? 'has-error' : ''; ?>">
                            <label>BCU</label>
                            <input type="text" name="bcu" class="form-control" value="<?php echo $bcu; ?>">
                            <span class="help-block"><?php echo $bcu_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre (*)  </label>				                          
							<input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($fecha_err)) ? 'has-error' : ''; ?>">
                            <label>Fecha Nacimiento(*)</label>
                            <label style="color:#F00; font-size:9px; font-weight:200;">Ejemplo: 29/08/2020</label>
                            <input type="text" name="fecha" class="form-control" value="<?php echo $fecha; ?>">
                            <span class="help-block"><?php echo $fecha_err;?></span>
                        </div>
                        
                       <div class="form-group <?php echo (!empty($raza_err)) ? 'has-error' : ''; ?>">
                            <label>Raza (*)</label>
                            <input type="text" name="raza" class="form-control" value="<?php echo $raza; ?>">
                            <span class="help-block"><?php echo $raza_err;?></span>
                        </div>
                        
                         <div class="form-group <?php echo (!empty($color_err)) ? 'has-error' : ''; ?>">
                            <label>Color (*)</label>
                            <input type="text" name="color" class="form-control" value="<?php echo $color; ?>">
                            <span class="help-block"><?php echo $color_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($pelaje_err)) ? 'has-error' : ''; ?>">
                            <label>Pelaje (*)</label>
                            <input type="text" name="pelaje" class="form-control" value="<?php echo $pelaje; ?>">
                            <span class="help-block"><?php echo $pelaje_err;?></span>
                        </div>
                        
                         <div class="form-group <?php echo (!empty($sexo_err)) ? 'has-error' : ''; ?>">
                            <label>Sexo (*)</label>
                                <select name="sexo" class="form-control" id="sexo">
                                  <option value="0">Seleccione</option>
                                  <option value="MACHO">MACHO</option>
                                  <option value="HEMBRA">HEMBRA</option>
                                </select>      
                                <span class="help-block"><?php echo $sexo_err;?></span>
                        </div>
                        
                         <div class="form-group <?php echo (!empty($unidad_err)) ? 'has-error' : ''; ?>">
                            <label>Unidad (*)</label>
                            <div class="search-box">
                                <input type="text" class="form-control" autocomplete="off" placeholder="Buscar unidad..." />
                           		<div class="result"></div>
                                <input type="text" hidden="true" name="unidad" class="result" value="<?php echo $unidad; ?>">
                            </div>
                            <span class="help-block"><?php echo $unidad_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

