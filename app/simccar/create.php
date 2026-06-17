<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$serie = $tarjeta = $imei = $marca =  $modelo = $ano = "";
$serie_err = $tarjeta_err = $imei_err = $marca_err = $modelo_err = $ano_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	 // Validate serie
    $input_serie = trim($_POST["serie"]);
    if(empty($input_serie)){
        $serie_err = "Por favor ingrese el número de serie.";     
    } else{
		$serie = $input_serie;
		//$serie_err = $input_serie; //borrar
    }	
	
	// Validate tarjeta
    $input_tarjeta = trim($_POST["tarjeta"]);
    if(empty($input_tarjeta)){
        $tarjeta_err = "Por favor ingrese la tarjeta.";  
	} elseif(!ctype_digit($input_tarjeta)){
        $tarjeta_err = "Por favor ingrese valores numéricos en la tarjeta.";   
    } else{
        $tarjeta = $input_tarjeta;
		//$tarjeta_err = $input_tarjeta; //borrar
    }
	
	// Validate imei
    $input_imei = trim($_POST["imei"]);
    if(empty($input_imei)){
        $imei_err = "Por favor ingrese el imei."; 
	} elseif(!ctype_digit($input_imei)){
        $imei_err = "Por favor ingrese valores numéricos en el imei.";    
    } else{
        $imei = $input_imei;
		//$imei_err = $input_imei; //borrar
    }
		
	// Validate marca
    $input_marca = trim($_POST["marca"]);
    if(empty($input_marca)){
        $marca_err = "Por favor seleccione la marca.";     
    } else{
        $marca = $input_marca;
		//$marca_err = $input_marca; //borrar
    }
	  
    // Validate modelo
   $input_modelo = trim($_POST["modelo"]); //trim: elimina espacio en blanco al inicio
    if(empty($input_modelo)){	
        $modelo_err = "Por favor seleccione un modelo de simccar.";
    } else{
        $modelo = $input_modelo;
		//$modelo_err = $input_modelo; //borrar
    }

    // Validate año
    $input_ano = trim($_POST["ano"]);
    if(empty($input_ano)){
        $ano_err = "Por favor ingrese el año."; 
	} elseif(!ctype_digit($input_ano)){
        $ano_err = "Por favor ingrese valores numéricos en el año.";      
    } else{
        $ano = $input_ano;
		//$ano_err = $input_ano; //borrar
    }
	
    // Check input errors before inserting in database
    if(empty($serie_err) && empty($tarjeta_err) && empty($imei_err) && empty($marca_err) && empty($modelo_err) && empty($ano_err)
		){
        // VALIDAMOS QUE NO EXISTA LA SIMCCAR
		$sqlVerificacion = "SELECT * FROM SIMCCAR WHERE SIM_SERIE = '$serie'";
							  
		$resultVerif = mysqli_query($link, $sqlVerificacion);
		$rowVerif = mysqli_fetch_array($resultVerif);	
		$existe = $rowVerif['SIM_SERIE'];
		
		$origen = 0;
		$estado = "SI";
		
		if(!empty($existe)){
		?>
			<script language="javascript"> 
                   alert ("El número de serie ingresado ya existe en la BD favor verifique sus datos"); 
            </script> 
		<?
		 }
		else{
			// Prepare an insert statement
      		$sqlInsert = "INSERT INTO SIMCCAR (SIM_SERIE, SIM_TARJETA, SIM_IMEI, MSIM_CODIGO, MODSIM_CODIGO, ANNO_FABRICACION, ORIGEN_SIMCCAR, VERIFICACION_ESTADO) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			//echo $sqlInsert;

			if($stmt = mysqli_prepare($link, $sqlInsert)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ssssssss", $param_serie, $param_tarjeta, $param_imei, $param_marca, $param_modelo, $param_ano, $param_origen, $param_estado);
				 
				// Set parameters
				$param_serie = $serie;
				$param_tarjeta = $tarjeta;
				$param_imei = $imei;
				$param_marca = $marca;
				$param_modelo = $modelo;
				$param_ano = $ano;
				$param_origen = $origen;
				$param_estado = $estado;

				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Records created successfully. Redirect to landing page
					//header("location: index.php");
					?>
						<script language="javascript"> 
                               alert ("SIMCCAR guardada satisfactoriamente en la BD."); 
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
    <title>Ingreso Simccar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    
    <script language="JavaScript">
		function cambiarModelo() {
		  var modelo = document.forms.formu.modelo.selectedIndex;
			alert(modelo);
		}
		
		function cambiarmarca() {
		  var marca = document.forms.formu.marca.selectedIndex;
			alert(marca);
		}
	</script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Ingreso Simccar Institucional</h2>
                    </div>
                    <p>Antes de ingresar una nueva Simccard verifique que ésta no haya sido agregada recientemente en el siguiente <a href="index.php">listado</a>.</p>
                    <p>Una vez corroborado lo anterior complete este formulario y envíelo para agregar el registro de una nueva SIMCCAR a la base de datos de Proservipol.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formu">
                                      
                        <div class="form-group <?php echo (!empty($serie_err)) ? 'has-error' : ''; ?>">
                            <label>Nro. de Serie (*)</label>
                            <input type="text" name="serie" class="form-control" value="<?php echo $serie; ?>">
                            <span class="help-block"><?php echo $serie_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($tarjeta_err)) ? 'has-error' : ''; ?>">
                            <label>Tarjeta</label>
                            <input type="text" name="tarjeta" class="form-control" value="<?php echo $tarjeta; ?>">
                            <span class="help-block"><?php echo $tarjeta_err;?></span>
                        </div>
                        
                         <div class="form-group <?php echo (!empty($imei_err)) ? 'has-error' : ''; ?>">
                            <label>Imei</label>
                            <input type="text" name="imei" class="form-control" value="<?php echo $imei; ?>">
                            <span class="help-block"><?php echo $imei_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($marca_err)) ? 'has-error' : ''; ?>">
                            <label>Marca (*)</label>
                                <select name="marca" class="form-control" id="marca">
                                  <option value="0">Seleccione</option>
                                  <option value="ANDROID">ANDROID</option>
                                  <option value="BLUEBIRD">BLUEBIRD</option>
                                  <option value="CAUTION">CAUTION</option>
                                  <option value="DOCKING STATION">DOCKING STATION</option> 
                                  <option value="GENVICT">GENVICT</option>
                                  <option value="HANDHELD">HANDHELD</option>
                                  <option value="MOTOROLA">MOTOROLA</option>
                                  <option value="SAMSUNG">SAMSUNG</option>
                                  <option value="SIMCCAR">SIMCCAR</option>
                                </select>      
                            <span class="help-block"><?php echo $marca_err;?></span>
                        </div>
  
                        <div class="form-group <?php echo (!empty($modelo_err)) ? 'has-error' : ''; ?>">
							<label>Modelo (*)</label>
                            <select name="modelo" class="form-control" id="modelo">
                                <option value="0">Seleccione</option>
                                <option value="ADDENDUM 205">ADDENDUM 205</option>
                                <option value="AF-500">AF-500</option>
                                <option value="B8700B">B8700B</option>
                                <option value="CE2200">CE2200</option>
                                <option value="E8700B">E8700B</option>
                                <option value="EF500">EF500</option>
                                <option value="EF-500M">EF-500M</option>
                                <option value="EF500IBI0">EF500IBI0</option>
                                <option value="EF501">EF501</option>
                                <option value="EF502">EF502</option>
                                <option value="EF503">EF503</option>
                                <option value="EF504">EF504</option>
                                <option value="EF550">EF550</option>
                                <option value="FINGERPRINTER">FINGERPRINTER</option>
                                <option value="MAAS360">MAAS360</option>
                                <option value="W8700B">W8700B</option>
                            </select>
                            <span class="help-block"><?php echo $modelo_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($ano_err)) ? 'has-error' : ''; ?>">
                            <label>Año de Fabricación</label>
                            <input type="text" name="ano" class="form-control" value="<?php echo $ano; ?>">
                            <span class="help-block"><?php echo $ano_err;?></span>
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

