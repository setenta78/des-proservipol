<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$codigo = $rut = $tipo = $fechaDesde = $fechaHasta = "";
$codigo_err = $rut_err = $tipo_err = $fechaDesde_err = $fechaHasta_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	 // Validate codigo
    $input_codigo = trim($_POST["codigo"]);
    if(empty($input_codigo)){
        $codigo_err = "Por favor ingrese el código de funcionario.";     
    } else{
		$codigo = $input_codigo;
		//$codigo_err = $codigo; //borrar
    }	
	
	// Validate rut
    $input_rut = trim($_POST["rut"]);
    if(empty($input_rut)){
        $rut_err = "Por favor ingrese el rut del funcionario.";     
    } else{
		$rut = $input_rut;
		//$rut_err = $rut; //borrar
    }	
	
	 // Validate tipo
    $input_tipo = trim($_POST["tipo"]);
    if($input_tipo == 0){
        $tipo_err = "Por favor ingrese el tipo de movimiento a eliminar.";     
    } else{
		$tipo = $input_tipo;
		//$tipo_err = $tipo; //borrar
    }	

	// Validate fecha desde
    $input_fechaDesde = trim($_POST["fechaDesde"]);
    if(empty($input_fechaDesde)){
        $fechaDesde_err = "Por favor ingrese la fecha inicial";     
    } else {
		$fechaDesdeTemp = $input_fechaDesde;
		$ano 			=	substr($fechaDesdeTemp, -4, 4);	
		$mes 			= 	substr($fechaDesdeTemp, 3, 2);	
		$dia 			= 	substr($fechaDesdeTemp, 0, 2);		
		$fechaDesde		=  	$ano.$mes.$dia;				
		//$fechaDesde_err = 	$fechaDesde; //borrar
    }	
	
	// Validate fecha desde
    $input_fechaHasta = trim($_POST["fechaHasta"]);
    if(empty($input_fechaHasta)){
        $fechaHasta_err = "Por favor ingrese la fecha final";     
    } else {
		$fechaHastaTemp = $input_fechaHasta;
		$ano =			substr($fechaHastaTemp, -4, 4);	
		$mes = 			substr($fechaHastaTemp, 3, 2);	
		$dia 			= 	substr($fechaHastaTemp, 0, 2);		
		$fechaHasta		=  	$ano.$mes.$dia;		
		//$fechaHasta_err = 	$fechaHasta; //borrar
	}	
	
	$sql = "SELECT YEAR(FECHA_LIMITE) ANNO
			,IF(MONTH(FECHA_LIMITE)<10,CONCAT('0',MONTH(FECHA_LIMITE)),MONTH(FECHA_LIMITE)) MES
			,IF(DAY(FECHA_LIMITE)<10,CONCAT('0',DAY(FECHA_LIMITE)),DAY(FECHA_LIMITE)) DIA
			FROM CONFIG_SYS
			WHERE ACTIVO = 1";
	$result = mysqli_query($link, $sql);
	while($myrow = mysqli_fetch_array($result)){
		$fechaLimite = $myrow["ANNO"].$myrow["MES"].$myrow["DIA"];
	}
	
	if($fechaDesde<$fechaLimite){
		?>
		<script language="javascript">
			alert("El mes que desea modificar, se encuentra cerrado");
		</script>
		<?
	}
	
	if ($fechaHasta<$fechaDesde){
	?>
		<script language="javascript"> 
			   alert ("La fecha inicial no puede ser menor a la fecha final"); 
		</script> 
	<?
	}

	// Check input errors before inserting in database
	if(empty($codigo_err) && empty($rut_err) && empty($tipo_err) && empty($fechaDesde_err) && empty($fechaHasta_err) && ($fechaDesde>=$fechaLimite)){
		//validamos fechas
		$sql = "DELETE FS
				FROM
				FUNCIONARIO_SERVICIO FS
				JOIN SERVICIO S ON S.UNI_CODIGO = FS.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
				WHERE
					FS.FUN_CODIGO = '$codigo'
					AND S.FECHA BETWEEN '$fechaDesde' AND '$fechaHasta' 
					AND S.TSERV_CODIGO = $tipo";
					
		if (mysqli_query($link, $sql)) {
		?>
			<script language="javascript"> 
            alert ("Registro eliminado de tabla de servicio"); 
      </script>
<?
		if ($tipo = 633 || $tipo = 717 ||  $tipo = 630 ||  $tipo = 718 ||  $tipo = 632 ||  $tipo = 180 ||  $tipo = 170 ||  $tipo = 631 ||  $tipo = 162){
				$sql2 = "DELETE 
						FROM
						LICENCIA_MEDICA 
						WHERE
						FUN_RUT = '$rut'
						AND FECHA_INICIO = '$fechaDesde'  
						AND FECHA_TERMINO = '$fechaHasta' 
						AND TIPO_LICENCIA_MEDICA = $tipo";
			}else 
			{
				$sql2 = "DELETE 
						FROM
						FERPER 
						WHERE
						FUN_RUT = '$rut'
						AND FECHA_INICIO = '$fechaDesde'  
						AND FECHA_TERMINO = '$fechaHasta' 
						AND TIPO_PERMISO = $tipo";
			}
			if (mysqli_query($link, $sql2)) {
			?>
				<script language="javascript"> 
              alert ("REGISTRO ELIMINADO DE FERPER O LICENCIA MÉDICA"); 
        </script> 
		
					
			<? }
        else {
              echo "Error al eliminar de FERPER O LICENCIA MÉDICA " . mysqli_error($conn);
              echo $sql2;
        }

		} else {
		      echo "Error al eliminar el registro de ss: " . mysqli_error($conn);
		      echo $sql;
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
    <title>ELIMINAR FERPER/LICENCIA</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    
    <script src="js/jsCalendar.js" type="text/javascript" language="javascript"></script>
	<script src="js/jsCalendar.datepicker.js" type="text/javascript" language="javascript"></script>
    <script src="js/jsCalendar.lang.es.js" type="text/javascript" language="javascript"></script>
    <link rel="stylesheet" href="css/jsCalendar.css" type="text/css"/>
    <link rel="stylesheet" href="css/jsCalendar.micro.css" type="text/css"/>
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
	<script>
      $( function() {
        $( "#datepicker" ).datepicker();
      } );
    </script>

    <script language="JavaScript">

		
	function cambiartipo() {
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
                        <h3>Eliminar Feriados, Permisos, Licencias y Días Administrativos.</h2>
                    </div>
                    <p>Antes de eliminar un movimiento verifique que los datos ingresados sean los correctos, ésta operación <strong>NO</strong> podrá deshacerse.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formu">
                      <div class="form-group <?php echo (!empty($codigo_err)) ? 'has-error' : ''; ?>">
                        <label>Código de Funcionario (*)</label>
                           <input name="codigo" type="text" class="form-control" value="<?php echo $codigo; ?>" maxlength="7">
                           <span class="help-block"><?php echo $codigo_err;?></span>
                      </div>
                      <div class="form-group <?php echo (!empty($rut_err)) ? 'has-error' : ''; ?>">
                        <label>Rut (*)</label>
                           <input name="rut" type="text" class="form-control" value="<?php echo $rut; ?>" maxlength="9">
                           <span class="help-block"><?php echo $rut_err;?></span>
                      </div>             
                        <div class="form-group <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo Servicio (*)</label>
                          <select name="tipo" class="form-control" id="tipo">
                            <option value="0">Seleccione</option>
                            <option value="130">Feriado</option>
                            <option value="799">Feriado zona extrema</option>
                            <option value="722">Permiso - Administrativos hasta 6 dias</option>
                            <option value="723">Permiso especial DIGCAR </option>
                            <option value="713">Permiso Post - natal Parental</option>
                            <option value="725">PERMISO - NACIMIENTO HIJO 5 DIAS</option>  
                            <option value="860">RELA - Contacto Estrecho COVID</option>     
                            <option value="863">Permiso Parental Preventivo S/G/R Ley 21351</option>  
                            <option value="846">Teletrabajo</option>    
                            <option value="633">Enfermedad Común</option>
                            <option value="717">Licencia Medica Pendiente</option>                            
                            <option value="630">Enfermedad Profesional</option>
                            <option value="718">Accidente en acto de servicio</option> 
                            <option value="632">ENFERMEDAD MEDICINA PREVENTIVA</option>   
                            <!--
                            <option value="180">POS-NATAL</option>      
                            <option value="170">PRE-NATAL</option> 
                            -->
                            <option value="170">LICENCIA MATERNAL PRE Y POST NATAL</option> 
                            <option value="631">Patologia del embarazo</option>   
                            <option value="162">ENFERMEDAD GRAVE HIJO MENOR DE 1 AÑO</option> 
                          </select>  
                          <span class="help-block"><?php echo $tipo_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($fechaDesde_err)) ? 'has-error' : ''; ?>"><label>Fecha desde (*)</label>
                            <input name="fechaDesde" type="text" id="fechaDesde"  class="campos" size="10" data-years-line="3" data-date="now" data-datepicker data-language="es" data-class="material-theme micro-theme green"/>
                            <span class="help-block"><?php echo $fechaDesde_err;?></span>
                        </div>
                      <div class="form-group <?php echo (!empty($fechaHasta_err)) ? 'has-error' : ''; ?>"><label>Fecha hasta (*)</label>
                            <input name="fechaHasta" type="text" id="fechaHasta"  class="campos" size="10" data-years-line="3" data-date="now" data-datepicker data-language="es" data-class="material-theme micro-theme green"/>
                            <span class="help-block"><?php echo $fechaHasta_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($fechaHasta_err)) ? 'has-error' : ''; ?>"></div>
                        
			<input type="submit" class="btn btn-danger btn-sm" value="Eliminar" >
 <!--<a href='delete.php?id=". $row['SIM_CODIGO'] ."' title='Eliminar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>-->
                        <a href="servicios.php" class="btn btn-default btn-sm">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
<br><br>
<?php include '../footer.php';?>
</body>
</html>

