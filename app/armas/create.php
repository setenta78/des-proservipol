<?php
// Include config file
require_once "config.php";

$sqlMarca = "SELECT 
			  `MARCA_ARMA`.`MARM_CODIGO`,
			  `MARCA_ARMA`.`MARM_DESCRIPCION`
			FROM
			  `MARCA_ARMA`
			ORDER BY `MARCA_ARMA`.`MARM_DESCRIPCION` ASC";
$resultMarca = mysqli_query($link, $sqlMarca);


// Attempt select query execution
$sqlModelo = "SELECT 
				  `MODELO_ARMA`.`MODARM_CODIGO`,
				  `MODELO_ARMA`.`MARM_CODIGO`,
				  `MODELO_ARMA`.`MODARM_DESCRIPCION`
				FROM
				  `MODELO_ARMA`";
				  
$result = mysqli_query($link, $sqlModelo);
//$row = mysqli_fetch_array($result);		 
 
// Define variables and initialize with empty values
$marca = $modelo = $tipo = $serie = $bcu = "";
$marca_err = $modelo_err = $tipo_err = $serie_err = $bcu_err = "";
 
// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

	
    //echo "<script>console.log('Console: dfsdfsdafsadfsadfsadfasfds' );jQuery(#'botonGuardar').prop('disabled', true); </script>";


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
    
    // Validate tipo
    $input_tipo = trim($_POST["tipo"]);
    if(empty($input_tipo)){
        $tipo_err = "Por favor seleccione el tipo de armamento.";     
    } else{
	//	$tipo_err = $input_tipo; //borrar
        $tipo = $input_tipo;
    }
    
    // Validate serie
    $input_serie = trim($_POST["serie"]);
    if(empty($input_serie)){
        $serie_err = "Por favor ingrese el número de serie.";     
    } else{
		//$serie_err = $input_serie; //borrar
        $serie = $input_serie;
    }
	
	// Validate serie
    $input_bcu = trim($_POST["bcu"]);
	$bcu = $input_bcu;
	
	//$bcu_err = $input_bcu; //borrar
	
	//bcu no será obligatorio x mientras
  /*  if(empty($input_bcu)){
        $bcu_err = "Por favor ingrese el BCU.";     
    } else{
        $bcu = $input_bcu;
    }*/
    
    // Check input errors before inserting in database
    if(empty($marca_err) &&  empty($modelo_err) && empty($tipo_err) && empty($serie_err) && empty($bcu_err)
	){
        // VALIDAMOS QUE NO EXISTA EL ARMA
		$sqlVerificacion = "SELECT * FROM ARMA WHERE ARM_NUMEROSERIE = '$serie'";
							  
		$resultVerif = mysqli_query($link, $sqlVerificacion);
		$rowVerif = mysqli_fetch_array($resultVerif);	
		$existe = $rowVerif['ARM_NUMEROSERIE'];
		
		if(!empty($existe)){
		?>
			<script language="javascript"> 
                   alert ("El número de serie ingresado ya existe en la BD favor verifique sus datos"); 
            </script> 
		<?
		 }
		else{
			/*$sqlInsert = "INSERT INTO ARMA (MODARM_CODIGO, TARM_CODIGO, ARM_NUMEROSERIE, ARM_BCU)
					VALUES (".$modelo.", ".$tipo.", '".$serie."', '".$bcu."')";
					
					if (mysqli_query($link, $sqlInsert)) {
					  echo "New record created successfully";
					} else {
					  echo "Error: " . $sqlInsert . "<br>" . mysqli_error($link);
					}
			*/
			// Prepare an insert statement
      		$sqlInsert = "INSERT INTO ARMA (MODARM_CODIGO, TARM_CODIGO, ARM_NUMEROSERIE, ARM_BCU) VALUES (?, ?, ?, ?)";
			//echo $sqlInsert;

			if($stmt = mysqli_prepare($link, $sqlInsert)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ssss", $param_modelo, $param_tipo, $param_serie, $param_bcu);
				 
				// Set parameters
				$param_modelo = $modelo;
				$param_tipo = $tipo;
				$param_serie = $serie;
				$param_bcu = $bcu;
			   
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Records created successfully. Redirect to landing page
					//header("location: index.php");
					?>
						<script language="javascript"> 
                               alert ("Arma guardada satisfactoriamente en la BD."); 
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
    
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
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

        
        //$('#botonGuardar').click(function () {
         //   $('#botonGuardar').attr('disabled', true);
        //});
        

    });

    
    </script>

    <script language="JavaScript">
		function cambiarModelo() {
		  var modelo = document.forms.formu.modelo.selectedIndex;
			alert(modelo);
		}
		
		function cambiarTipo() {
		  var tipo = document.forms.formu.tipo.selectedIndex;
			alert(tipo);
		}
	</script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Ingreso Armamento Institucional</h2>
                    </div>
                    <p>Complete este formulario y envíelo para agregar el registro de una nueva arma a la base de datos de Proservipol.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formu">
                        <div class="form-group <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo (*)</label>
                                <select name="tipo" class="form-control" id="tipo">
                                  <option value="0">Seleccione</option>
                                  <option value="10">AMETRALLADORA</option>
                                  <option value="20">CARABINA</option>
                                  <option value="30">ESCOPETA</option>
                                  <option value="40">FUSIL</option>
                                  <option value="50">SUBAMETRALLADORA</option>
                                  <option value="60">PISTOLA</option>
                                  <option value="70">REVOLVER</option>
                                  <option value="80">CARABINA LANZA GAS</option>
                                  <option value="90">RIFLE</option>
                                  <option value="100">CANON</option>
                                  <option value="110">SUBFUSIL</option>
                                </select>      
                                <span class="help-block"><?php echo $tipo_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($marca_err)) ? 'has-error' : ''; ?>">
                            <label>Marca (*)</label>
                            <select name="marca" class="form-control" id="marca">
								<?php 
                                while ($rowMarca = mysqli_fetch_array($resultMarca))
                                {
                                echo "<option value=" .$rowMarca['MARM_CODIGO']. ">".$rowMarca['MARM_DESCRIPCION']. "    (" .$rowMarca['MARM_CODIGO']. ") </option>";
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
                        
                        <div class="form-group <?php echo (!empty($serie_err)) ? 'has-error' : ''; ?>">
                            <label>Nro. de Serie (*)</label>
                            <input type="text" name="serie" class="form-control" value="<?php echo $serie; ?>">
                            <span class="help-block"><?php echo $serie_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($bcu_err)) ? 'has-error' : ''; ?>">
                            <label>BCU</label>
                            <input type="text" name="bcu" class="form-control" value="<?php echo $bcu; ?>">
                            <span class="help-block"><?php echo $bcu_err;?></span>
                        </div>

                        <input type="submit" id= "botonGuardar"  class="btn btn-primary" value="Guardar">
                        <a href="index.php" id="botonCancelar"  class="btn btn-default">Cancelar</a>
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

