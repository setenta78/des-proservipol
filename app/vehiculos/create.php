<?php
// Incluir la clase de conexión
require_once "../class/class.php";

// Crear conexión a la base de datos
$con = Conectar::con(); // Llamar a la clase Conectar para obtener la conexión

// Si la conexión es exitosa, continuar con el proceso de inserción
if ($con) {
    // Consultar los campos desde la base de datos
    $sqlTipo = "SELECT 
                  `TIPO_VEHICULO`.`TVEH_CODIGO`,
                  `TIPO_VEHICULO`.`TVEH_DESCRIPCION`,
                  `TIPO_VEHICULO`.`TVEH_CLASIFICACION`
                FROM
                  `TIPO_VEHICULO`
                ORDER BY `TIPO_VEHICULO`.`TVEH_DESCRIPCION` ASC";
    $resultTipo = mysqli_query($con, $sqlTipo);

    $sqlProcedencia = "SELECT 
                          `PROCEDENCIA_RECURSO`.`PREC_CODIGO`,
                          `PROCEDENCIA_RECURSO`.`PREC_DESCRIPCION`
                        FROM
                          `PROCEDENCIA_RECURSO`
                        ORDER BY `PROCEDENCIA_RECURSO`.`PREC_DESCRIPCION` ASC";
    $resultProcedencia = mysqli_query($con, $sqlProcedencia);

    $sqlMarca = "SELECT 
                  `MARCA_VEHICULO`.`MVEH_CODIGO`,
                  `MARCA_VEHICULO`.`MVEH_DESCRIPCION`
                FROM
                  `MARCA_VEHICULO`
                ORDER BY `MARCA_VEHICULO`.`MVEH_DESCRIPCION` ASC";
    $resultMarca = mysqli_query($con, $sqlMarca);

    // Variables de formulario
    $tipo = $procedencia = $bcu = $sap = $unidad = $marca = $modelo = $patente = $institucional = $ano = "";
    $tipo_err = $procedencia_err = $bcu_err = $sap_err = $unidad_err = $marca_err = $modelo_err = $patente_err = $institucional_err = $ano_err = "";

    // Procesar datos del formulario al enviarlo
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validar tipo
        $input_tipo = isset($_POST["tipo"]) ? trim($_POST["tipo"]) : '';
        if ($input_tipo == 0) {
            $tipo_err = "Por favor ingrese el tipo de vehículo.";
        } else {
            $tipo = $input_tipo;
        }

        // Validar procedencia
        $input_procedencia = isset($_POST["procedencia"]) ? trim($_POST["procedencia"]) : '';
        if (empty($input_procedencia)) {
            $procedencia_err = "Por favor ingrese la procedencia del vehículo.";
        } else {
            $procedencia = $input_procedencia;
        }

        // Validar bcu
        $input_bcu = isset($_POST["bcu"]) ? trim($_POST["bcu"]) : '';
        $bcu = empty($input_bcu) ? "" : $input_bcu;

        // Validar SAP
        $input_sap = isset($_POST["sap"]) ? trim($_POST["sap"]) : '';
        if (empty($input_sap)) {
            $sap = "";
        } else {
            if (!ctype_digit($input_sap)) {
                $sap_err = "Por favor ingrese valores numéricos al código SAP.";
            }
            $sap = $input_sap;
        }

        // Validar marca
        $input_marca = isset($_POST["marca"]) ? trim($_POST["marca"]) : '';
        if ($input_marca == 0) {
            $marca_err = "Por favor seleccione la marca.";
        } else {
            $marca = $input_marca;
        }

        // Validar modelo
        $input_modelo = isset($_POST["modelo"]) ? trim($_POST["modelo"]) : '';
        $modelo = $input_modelo == 0 ? "null" : $input_modelo;

        // Validar patente
        $input_patente = isset($_POST["patente"]) ? trim($_POST["patente"]) : '';
        $input_patente = str_replace(' ', '', $input_patente);
        if (empty($input_patente)) {
            $patente_err = "Por favor ingrese la patente.";
        } else {
            $patente = $input_patente;
        }

        // Validar institucional
        $input_institucional = isset($_POST["institucional"]) ? trim($_POST["institucional"]) : '';
        $input_institucional = str_replace(' ', '', $input_institucional);
        if (empty($input_institucional)) {
            $institucional_err = "Por favor ingrese el número institucional.";
        } else {
            $institucional = $input_institucional;
        }

        // Validar año
        $input_ano = isset($_POST["ano"]) ? trim($_POST["ano"]) : '';
        if (empty($input_ano)) {
            $ano_err = "Por favor ingrese el año.";
        } elseif (!ctype_digit($input_ano)) {
            $ano_err = "Por favor ingrese valores numéricos en el año.";
        } else {
            $ano = $input_ano;
        }

        // Validar unidad
        $input_unidadTemporal = isset($_POST["unidad"]) ? substr($_POST["unidad"], -5) : '';
        $input_unidad = empty($input_unidadTemporal) ? '' : intval(preg_replace('/[^0-9]+/', '', $input_unidadTemporal), 10);
        if (empty($input_unidad)) {
            $unidad_err = "Por favor ingrese la unidad del vehículo.";
        } else {
            $unidad = $input_unidad;
        }

        // Validar sin errores
        if (empty($tipo_err) && empty($procedencia_err) && empty($bcu_err) && empty($sap_err) && empty($marca_err) && empty($patente_err) && empty($institucional_err) && empty($ano_err)) {
            // Verificar si el vehículo ya existe
            $patenteExiste = "";
            $institucionalExiste = "";

            if ($patente != "") {
                $sqlVerificacion = "SELECT * FROM VEHICULO WHERE VEH_PATENTE = '$patente'";
                $resultVerif = mysqli_query($con, $sqlVerificacion);
                $rowVerif = mysqli_fetch_array($resultVerif);
                if (!empty($rowVerif['VEH_PATENTE'])) {
                    $patenteExiste = "SI";
                    echo "<script>alert('La patente ingresada ya existe en la BD, favor verifique los datos');</script>";
                }
            }

            if ($institucional != "") {
                $sqlVerificacion = "SELECT * FROM VEHICULO WHERE VEH_NUMEROINSITUCIONAL = '$institucional'";
                $resultVerif = mysqli_query($con, $sqlVerificacion);
                $rowVerif = mysqli_fetch_array($resultVerif);
                if (!empty($rowVerif['VEH_SAP'])) {
                    $institucionalExiste = "SI";
                    echo "<script>alert('Sigla institucional ingresada ya existe en la BD, favor verifique sus datos');</script>";
                }
            }

            // Si no existe patente ni código institucional, insertar
            if (empty($patenteExiste) && empty($institucionalExiste)) {
                $validaAno = 0;

                $sqlInsert = "INSERT INTO VEHICULO (TVEH_CODIGO, PREC_CODIGO, VEH_BCU, VEH_SAP, UNI_CODIGO, MVEH_CODIGO, MODVEH_CODIGO, VEH_PATENTE, VEH_NUMEROINSITUCIONAL, ANNO_FABRICACION, VALIDA_ANNO_FABRICACION) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                if ($stmt = mysqli_prepare($con, $sqlInsert)) {
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

                    // Ejecutar sentencia preparada
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script>alert('VEHICULO guardado satisfactoriamente en la BD.'); window.location.href = 'index.php';</script>";
                    } else {
                        echo "Algo salió mal. Reintente el registro.";
                    }
                    exit();
                }
            }
            // Cerrar la sentencia
            mysqli_stmt_close($stmt);
        }

        // Cerrar conexión
        mysqli_close($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ingreso Vehículo</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#marca').val(1);
            recargarLista();

            $('#marca').change(function () {
                recargarLista();
            });
        });

        function recargarLista() {
            $.ajax({
                type: "POST",
                url: "datosModelo.php",
                data: "marca=" + $('#marca').val(),
                success: function (r) {
                    $('#selectModelo').html(r);
                }
            });
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
                        <!-- Aquí irían los campos del formulario con validación -->
                        <div class="form-group <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo vehículo (*)</label>
                            <select name="tipo" class="form-control" id="tipo">
                                <?php 
                                    while ($rowTipo = mysqli_fetch_array($resultTipo)) {
                                        echo "<option value=" . $rowTipo['TVEH_CODIGO'] . ">" . $rowTipo['TVEH_DESCRIPCION'] . "  (" . $rowTipo['TVEH_CODIGO'] . ")</option>";
                                    }
                                ?>        
                            </select>
                            <span class="help-block"><?php echo $tipo_err; ?></span>
                        </div>
                        <!-- Aquí seguirían los demás campos como Procedencia, BCU, SAP, Marca, etc. -->
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

