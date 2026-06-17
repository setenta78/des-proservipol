<?php
// Include config file
require_once "config.php";

// CONSULTAS DE CAMPOS QUE SE CARGAN DIRECTAMENTE DESDE BD
$sqlTipo = "SELECT 
			  `TIPO_VEHICULO`.`TVEH_CODIGO`,
			  `TIPO_VEHICULO`.`TVEH_DESCRIPCION`,
			  `TIPO_VEHICULO`.`TVEH_CLASIFICACION`
			FROM
			  `TIPO_VEHICULO`
			 ORDER BY `TIPO_VEHICULO`.`TVEH_DESCRIPCION` ASC";
$resultTipo = mysqli_query($link, $sqlTipo);

$sqlProcedencia = "SELECT 
					  `PROCEDENCIA_RECURSO`.`PREC_CODIGO`,
					  `PROCEDENCIA_RECURSO`.`PREC_DESCRIPCION`
					FROM
					  `PROCEDENCIA_RECURSO`
					 ORDER BY `PROCEDENCIA_RECURSO`.`PREC_DESCRIPCION` ASC";
$resultProcedencia = mysqli_query($link, $sqlProcedencia);

$sqlMarca = "SELECT 
			  `MARCA_VEHICULO`.`MVEH_CODIGO`,
			  `MARCA_VEHICULO`.`MVEH_DESCRIPCION`
			FROM
			  `MARCA_VEHICULO`
			 ORDER BY `MARCA_VEHICULO`.`MVEH_DESCRIPCION` ASC";
$resultMarca = mysqli_query($link, $sqlMarca);
  
// Define variables and initialize with empty values

$tipo = $procedencia = $bcu = $sap = $unidad = $marca =  $modelo =  $patente =  $institucional  = $ano =   "";
$tipo_err = $procedencia_err = $bcu_err = $sap_err = $unidad_err = $marca_err = $modelo_err = $patente_err = $institucional_err = $ano_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	 // Validate tipo
    $input_tipo = trim($_POST["tipo"]);
    if($input_tipo == 0){
        $tipo_err = "Por favor ingrese el tipo de vehículo.";     
    } else{
		$tipo = $input_tipo;
	//	$tipo_err = $tipo; //borrar
    }	
	
	// Validate procedencia
    $input_procedencia = trim($_POST["procedencia"]);
    if(empty($input_procedencia)){
        $procedencia_err = "Por favor ingrese la procedencia del vehículo.";     
    } else{
		$procedencia = $input_procedencia;
	//	$procedencia_err = $procedencia; //borrar
    }	
	
	// Validate bcu
    $input_bcu = trim($_POST["bcu"]);
    if(empty($input_bcu)){
        $bcu = "";     
    } else {
		$bcu = $input_bcu;
	//	$bcu_err = $bcu; //borrar
    }	
	
	// Validate sap
    $input_sap = trim($_POST["sap"]);
    if(empty($input_sap)){
        $sap = ""; 
	} 
    else{
        if(!ctype_digit($input_sap)){
            $sap_err = "Por favor ingrese valores numéricos al código SAP.";   
        }  
        $sap = $input_sap;
	//	$sap_err = $sap; //borrar
    }
	
	// Validate marca
    $input_marca = trim($_POST["marca"]);
    if($input_marca == 0){
        $marca_err = "Por favor seleccione la marca.";     
    } else{
        $marca = $input_marca;
	//	$marca_err = $marca; //borrar
    }
	  
    // Validate modelo
	
   $input_modelo = trim($_POST["modelo"]); //trim: elimina espacio en blanco al inicio
    if($input_modelo == 0){	
        $modelo = "null";
    } else{
        $modelo = $input_modelo;
	//	$modelo_err = $modelo; //borrar
    }
	
	// Validate patente
    $input_patente = trim($_POST["patente"]);
	$input_patente = str_replace(' ', '', $input_patente);
	
    if(empty($input_patente)){
        $patente_err = "Por favor ingrese la patente."; 
    } else{
        $patente = $input_patente;
	//	$patente_err = $patente; //borrar
    }
	
	// Validate institucional
    $input_institucional = trim($_POST["institucional"]);
	$input_institucional = str_replace(' ', '', $input_institucional);
	
    if(empty($input_institucional)){
        $institucional_err = "Por favor ingrese el número institucional."; 
    } else{
        $institucional = $input_institucional;
	//	$institucional_err = $institucional; //borrar
    }

    // Validate año
    $input_ano = trim($_POST["ano"]);
    if(empty($input_ano)){
        $ano_err = "Por favor ingrese el año."; 
	} elseif(!ctype_digit($input_ano)){
        $ano_err = "Por favor ingrese valores numéricos en el año.";      
    } else{
        $ano = $input_ano;
	//	$ano_err = $ano; //borra
    }
	
	// Validate unidad
	 $input_unidadTemporal = substr($_POST["unidad"], -5); 
	 $input_unidad = intval(preg_replace('/[^0-9]+/', '', $input_unidadTemporal), 10);
	 if(empty($input_unidad)){
        $unidad_err = "Por favor ingrese la unidad del vehículo."; 
	}
	else{
        $unidad = $input_unidad;
		//$unidad_err = $unidad; //borra
    }
  /*  $input_unidadTemporal = trim($_POST["unidad"]);
	$input_unidad = intval(preg_replace('/[^0-9]+/', '', $input_unidadTemporal), 10);
    if(empty($input_unidad)){
        $unidad_err = "Por favor ingrese la unidad del vehículo."; 
	}
	else{
        $unidad = $input_unidad;
		$unidad_err = $unidad; //borra
    }
*/

    // Check input errors before inserting in database //  && empty($unidad_err)
    if(empty($tipo_err) && empty($procedencia_err) && empty($bcu_err) && empty($sap_err) && empty($marca_err) && empty($patente_err) && empty($institucional_err) && empty($ano_err)){

        // VALIDAMOS QUE NO EXISTA EL VEHICULO
		$patenteExiste = "";
		$institucionalExiste = "";
		
		if ($patente != "")
		{
			$sqlVerificacion = "SELECT * FROM VEHICULO WHERE VEH_PATENTE = '$patente'";
								  
			$resultVerif = mysqli_query($link, $sqlVerificacion);
			$rowVerif = mysqli_fetch_array($resultVerif);	
			$existe = $rowVerif['VEH_PATENTE'];
			
			if(!empty($existe)){
				$patenteExiste = "SI";
			
			?>
				<script language="javascript"> 
					alert ("La patente ingresada ya existe en la BD, favor verifique los datos"); 
				</script> 
			<?
			}
		}
		
		if ($institucional != "")
		{
			$sqlVerificacion = "SELECT * FROM VEHICULO WHERE VEH_NUMEROINSITUCIONAL = '$institucional'";
								  
			$resultVerif = mysqli_query($link, $sqlVerificacion);
			$rowVerif = mysqli_fetch_array($resultVerif);	
			$existe = $rowVerif['VEH_SAP'];
			
			if(!empty($existe)){
				$institucionalExiste = "SI";
			
			?>
				<script language="javascript"> 
					alert ("Sigla institucional ingresada ya existe en la BD, favor verifique sus datos"); 
				</script> 
			<?
			}
		}
		

		//VALIDAMOS QUE NO EXISTA patente y codigo institucional
		if(empty($patenteExiste) && empty($institucionalExiste) ){
			$validaAno = 0;
			
			// Prepare an insert statement
			$sqlInsert = "INSERT INTO VEHICULO (TVEH_CODIGO, PREC_CODIGO, VEH_BCU, VEH_SAP, UNI_CODIGO, MVEH_CODIGO, MODVEH_CODIGO, VEH_PATENTE, VEH_NUMEROINSITUCIONAL, ANNO_FABRICACION, VALIDA_ANNO_FABRICACION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			// echo $sqlInsert;

			if($stmt = mysqli_prepare($link, $sqlInsert)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "sssssssssss", $param_tipo, $param_procedencia, $param_bcu, $param_sap, $param_unidad, $param_marca, $param_modelo, $param_patente, $param_institucional, $param_ano, $param_validaAno);	
			
			// Set parameters
			$param_tipo = $tipo;
			$param_procedencia = $procedencia;
			$param_bcu = $bcu;
			$param_sap = $sap;
			$param_unidad = $unidad;
			$param_marca = $marca;
			$param_modelo = $modelo;
			$param_patente = $patente;
			$param_institucional = $institucional;
			$param_ano = $ano;
			$param_validaAno = $validaAno;
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				// Records created successfully. Redirect to landing page
				?>
					<script language="javascript"> 
						   alert ("VEHICULO guardado satisfactoriamente en la BD."); 
						   window.location.href = 'index.php';
					</script> 
				<?

			} else{
				echo "Algo salio mal. Reintente el registro.";
				//echo $sqlInsert;
			}
			exit();
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
<html lang="en"><head>
    <meta charset="UTF-8">
    <title>Ingreso Vehículo</title>
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
                        <h2>Ingreso Vehículo Institucional</h2>
                    </div>
                    <p>Antes de ingresar un nuevo Vehículo verifique que éste no haya sido agregado recientemente en el siguiente <a href="index.php">listado</a>. Una vez corroborado lo anterior complete este formulario y envíelo para agregar el registro de un nuevo Vehículo a la base de datos de Proservipol.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formu">
                                      
                        <div class="form-group <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo vehículo (*)</label>
                            <select name="tipo" class="form-control" id="tipo">
								<?php 
                                while ($rowTipo = mysqli_fetch_array($resultTipo))
                                {
                                echo "<option value=" .$rowTipo['TVEH_CODIGO']. ">" .$rowTipo['TVEH_DESCRIPCION']."  (".$rowTipo['TVEH_CODIGO']. ")</option>";
                                }
                                ?>        
                            </select>
                            <span class="help-block"><?php echo $tipo_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($procedencia_err)) ? 'has-error' : ''; ?>">
                       		<label>Procedencia (*)</label>
                              <select name="procedencia" class="form-control" id="procedencia">
								<?php 
                                while ($rowProcedencia = mysqli_fetch_array($resultProcedencia))
                                {
                                echo "<option value=" .$rowProcedencia['PREC_CODIGO']. ">" .$rowProcedencia['PREC_DESCRIPCION']." (".$rowProcedencia['PREC_CODIGO']. ")</option>";
                                }
                                ?>        
                            </select>
                            <span class="help-block"><?php echo $procedencia_err;?></span>
                        </div>
                        
                      <div class="form-group <?php echo (!empty($bcu_err)) ? 'has-error' : ''; ?>">
                        <label>BCU</label>
                         <label style="color:#F00; font-size:9px; font-weight:200;">SI NO CUENTA CON BCU INGRESE EL CÓDIGO SAP ANTECEDIDO POR LA CANTIDAD DE CEROS NECESARIA PARA COMPLETAR 11 CARÁCTERES.</label>
                         <input name="bcu" type="text" class="form-control" value="<?php echo $bcu; ?>" maxlength="11">
                         <span class="help-block"><?php echo $bcu_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($sap_err)) ? 'has-error' : ''; ?>">
                            <label>SAP</label>
(*)                            
<input type="text" name="sap" class="form-control" value="<?php echo $sap; ?>">
                            <span class="help-block"><?php echo $sap_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($marca_err)) ? 'has-error' : ''; ?>">
                            <label>Marca (*)</label>
                            <select name="marca" class="form-control" id="marca">
								<?php 
                                while ($rowMarca = mysqli_fetch_array($resultMarca))
                                {
                                echo "<option value=" .$rowMarca['MVEH_CODIGO']. ">".$rowMarca['MVEH_DESCRIPCION']. " (" .$rowMarca['MVEH_CODIGO'].")</option>";
                                }
                                ?>        
                            </select>      
                            <span class="help-block"><?php echo $marca_err;?></span>
                        </div>
  
                        <div class="form-group <?php echo (!empty($modelo_err)) ? 'has-error' : ''; ?>">
							<label>Modelo </label>
                            <div id="selectModelo"></div>
                            <span class="help-block"><?php echo $modelo_err;?></span>
                        </div>
     
                      <div class="form-group <?php echo (!empty($patente_err)) ? 'has-error' : ''; ?>">
                            <label>Patente / PPU (*)</label>
                            <label style="color:#F00; font-size:10px; font-weight:200;">NO UTILICE GUIONES NI ESPACIOS, Ej: RP5463, Z4856.</label>
                            <input type="text" name="patente" class="form-control" value="<?php echo $patente; ?>">
                            <span class="help-block"><?php echo $patente_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($institucional_err)) ? 'has-error' : ''; ?>">
                            <label>Número o Sigla Institucional</label>
(*)                            
<label style="color:#F00; font-size:10px; font-weight:200;">EL FORMATO DE INGRESO ES SIN GUIÓN NI ESPACIOS, Ej: RP5463, Z4856.</label>
                            <input type="text" name="institucional" class="form-control" value="<?php echo $institucional; ?>">
                            <span class="help-block"><?php echo $institucional_err;?></span>
                        </div>
                        
                       <div class="form-group <?php echo (!empty($ano_err)) ? 'has-error' : ''; ?>">
                            <label>Año de Fabricación (*)</label>
                            <input type="text" name="ano" class="form-control" value="<?php echo $ano; ?>">
                            <span class="help-block"><?php echo $ano_err;?></span>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#marca').val(1);
		recargarLista();

		$('#marca').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"datosModelo.php",
			data:"marca=" + $('#marca').val(),
			success:function(r){
				$('#selectModelo').html(r);
			}
		});
	}
</script>
