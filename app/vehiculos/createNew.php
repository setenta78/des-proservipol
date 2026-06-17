<?php
// Include config file
require_once "config.php";

// Consultas de campos que se cargan directamente desde la base de datos
$sqlTipo = "SELECT `TVEH_CODIGO`, `TVEH_DESCRIPCION` FROM `TIPO_VEHICULO` ORDER BY `TVEH_DESCRIPCION` ASC";
$resultTipo = mysqli_query($link, $sqlTipo);

$sqlProcedencia = "SELECT `PREC_CODIGO`, `PREC_DESCRIPCION` FROM `PROCEDENCIA_RECURSO` ORDER BY `PREC_DESCRIPCION` ASC";
$resultProcedencia = mysqli_query($link, $sqlProcedencia);

$sqlMarca = "SELECT `MVEH_CODIGO`, `MVEH_DESCRIPCION` FROM `MARCA_VEHICULO` ORDER BY `MVEH_DESCRIPCION` ASC";
$resultMarca = mysqli_query($link, $sqlMarca);

// Inicialización de variables
$tipo = $procedencia = $bcu = $sap = $unidad = $marca = $modelo = $patente = $institucional = $ano = "";
$tipo_err = $procedencia_err = $bcu_err = $sap_err = $unidad_err = $marca_err = $modelo_err = $patente_err = $institucional_err = $ano_err = "";

// Procesar datos del formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar tipo
    $input_tipo = trim($_POST["tipo"]);
    if ($input_tipo == 0) {
        $tipo_err = "Por favor ingrese el tipo de vehículo.";
    } else {
        $tipo = $input_tipo;
    }

    // Validar procedencia
    $input_procedencia = trim($_POST["procedencia"]);
    if (empty($input_procedencia)) {
        $procedencia_err = "Por favor ingrese la procedencia del vehículo.";
    } else {
        $procedencia = $input_procedencia;
    }

    // Validar BCU
    $input_bcu = trim($_POST["bcu"]);
    $bcu = empty($input_bcu) ? "" : $input_bcu;

    // Validar SAP
    $input_sap = trim($_POST["sap"]);
    if (empty($input_sap)) {
        $sap = "";
    } elseif (!ctype_digit($input_sap)) {
        $sap_err = "Por favor ingrese valores numéricos al código SAP.";
    } else {
        $sap = $input_sap;
    }

    // Validar marca
    $input_marca = trim($_POST["marca"]);
    if ($input_marca == 0) {
        $marca_err = "Por favor seleccione la marca.";
    } else {
        $marca = $input_marca;
    }

    // Validar modelo
    $input_modelo = trim($_POST["modelo"]);
    $modelo = $input_modelo == 0 ? "null" : $input_modelo;

    // Validar patente
    $input_patente = trim(str_replace(' ', '', $_POST["patente"]));
    if (empty($input_patente)) {
        $patente_err = "Por favor ingrese la patente.";
    } else {
        $patente = $input_patente;
    }

    // Validar institucional
    $input_institucional = trim(str_replace(' ', '', $_POST["institucional"]));
    if (empty($input_institucional)) {
        $institucional_err = "Por favor ingrese el número institucional.";
    } else {
        $institucional = $input_institucional;
    }

    // Validar año
    $input_ano = trim($_POST["ano"]);
    if (empty($input_ano)) {
        $ano_err = "Por favor ingrese el año.";
    } elseif (!ctype_digit($input_ano)) {
        $ano_err = "Por favor ingrese valores numéricos en el año.";
    } else {
        $ano = $input_ano;
    }

    // Validar unidad
    $input_unidadTemporal = substr($_POST["unidad"], -5);
    $input_unidad = intval(preg_replace('/[^0-9]+/', '', $input_unidadTemporal), 10);
    if (empty($input_unidad)) {
        $unidad_err = "Por favor ingrese la unidad del vehículo.";
    } else {
        $unidad = $input_unidad;
    }

    // Verificar errores antes de insertar en la base de datos
    if (empty($tipo_err) && empty($procedencia_err) && empty($bcu_err) && empty($sap_err) && empty($marca_err) && empty($patente_err) && empty($institucional_err) && empty($ano_err)) {
        // Validamos que no exista el vehículo
        $patenteExiste = "";
        $institucionalExiste = "";

        if ($patente != "") {
            $sqlVerificacion = "SELECT * FROM VEHICULO WHERE VEH_PATENTE = '$patente'";
            $resultVerif = mysqli_query($link, $sqlVerificacion);
            $rowVerif = mysqli_fetch_array($resultVerif);
            $existe = $rowVerif['VEH_PATENTE'];

            if (!empty($existe)) {
                $patenteExiste = "SI";
                echo "<script>alert('La patente ingresada ya existe en la BD, favor verifique los datos');</script>";
            }
        }

        if ($institucional != "") {
            $sqlVerificacion = "SELECT * FROM VEHICULO WHERE VEH_NUMEROINSITUCIONAL = '$institucional'";
            $resultVerif = mysqli_query($link, $sqlVerificacion);
            $rowVerif = mysqli_fetch_array($resultVerif);
            $existe = $rowVerif['VEH_SAP'];

            if (!empty($existe)) {
                $institucionalExiste = "SI";
                echo "<script>alert('Sigla institucional ingresada ya existe en la BD, favor verifique sus datos');</script>";
            }
        }

        // Validamos que no exista patente y código institucional
        if (empty($patenteExiste) && empty($institucionalExiste)) {
            $validaAno = 0;

            // Preparar una declaración de inserción
            $sqlInsert = "INSERT INTO VEHICULO (TVEH_CODIGO, PREC_CODIGO, VEH_BCU, VEH_SAP, UNI_CODIGO, MVEH_CODIGO, MODVEH_CODIGO, VEH_PATENTE, VEH_NUMEROINSITUCIONAL, ANNO_FABRICACION, VALIDA_ANNO_FABRICACION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($link, $sqlInsert)) {
                // Asociar variables a la declaración preparada como parámetros
                mysqli_stmt_bind_param($stmt, "sssssssssss", $param_tipo, $param_procedencia, $param_bcu, $param_sap, $param_unidad, $param_marca, $param_modelo, $param_patente, $param_institucional, $param_ano, $param_validaAno);

                // Establecer parámetros
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

                // Intentar ejecutar la declaración preparada
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('VEHICULO guardado satisfactoriamente en la BD.'); window.location.href = 'index.php';</script>";
                } else {
                    echo "Algo salió mal. Reintente el registro.";
                }
                exit();
            }
        }
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }
    // Cerrar conexión
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ingreso Vehículo</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <script type="text/javascript">
        $(document).ready(function() {
            $('#marca').val(1);
            recargarLista();

            $('#marca').change(function() {
                recargarLista();
            });
        })

        function recargarLista() {
            $.ajax({
                type: "POST",
                url: "datosModelo.php",
                data: "marca=" + $('#marca').val(),
                success: function(r) {
                    $('#selectModelo').html(r);
                }
            });
        }

        $(document).ready(function() {
            $('.search-box input[type="text"]').on("keyup input", function() {
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("backend-search.php", {
                        term: inputVal
                    }).done(function(data) {
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });

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

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-6">Ingreso Vehículo</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-4">
                    <label for="tipo" class="block text-gray-700">Tipo de Vehículo</label>
                    <select name="tipo" class="block w-full border rounded p-2 <?php echo (!empty($tipo_err)) ? 'border-red-500' : ''; ?>">
                        <option value="0">Seleccione...</option>
                        <?php
                        if (mysqli_num_rows($resultTipo) > 0) {
                            while ($rowTipo = mysqli_fetch_array($resultTipo)) {
                                echo "<option value='" . $rowTipo['TVEH_CODIGO'] . "' " . ($rowTipo['TVEH_CODIGO'] == $tipo ? "selected" : "") . ">" . $rowTipo['TVEH_DESCRIPCION'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $tipo_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="procedencia" class="block text-gray-700">Procedencia</label>
                    <select name="procedencia" class="block w-full border rounded p-2 <?php echo (!empty($procedencia_err)) ? 'border-red-500' : ''; ?>">
                        <option value="">Seleccione...</option>
                        <?php
                        if (mysqli_num_rows($resultProcedencia) > 0) {
                            while ($rowProcedencia = mysqli_fetch_array($resultProcedencia)) {
                                echo "<option value='" . $rowProcedencia['PREC_CODIGO'] . "' " . ($rowProcedencia['PREC_CODIGO'] == $procedencia ? "selected" : "") . ">" . $rowProcedencia['PREC_DESCRIPCION'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $procedencia_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="bcu" class="block text-gray-700">BCU</label>
                    <input type="text" name="bcu" class="block w-full border rounded p-2 <?php echo (!empty($bcu_err)) ? 'border-red-500' : ''; ?>" value="<?php echo $bcu; ?>">
                    <span class="text-red-500 text-sm"><?php echo $bcu_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="sap" class="block text-gray-700">SAP</label>
                    <input type="text" name="sap" class="block w-full border rounded p-2 <?php echo (!empty($sap_err)) ? 'border-red-500' : ''; ?>" value="<?php echo $sap; ?>">
                    <span class="text-red-500 text-sm"><?php echo $sap_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="sap" class="block text-gray-700">Marca</label>
                    <select name="marca" class="block w-full border rounded p-2 <?php echo (!empty($marca_err)) ? 'border-red-500' : ''; ?>" id="marca">
                        <?php
                        while ($rowMarca = mysqli_fetch_array($resultMarca)) {
                            echo "<option value=" . $rowMarca['MVEH_CODIGO'] . ">" . $rowMarca['MVEH_DESCRIPCION'] . " (" . $rowMarca['MVEH_CODIGO'] . ")</option>";
                        }
                        ?>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $marca_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="sap" class="block text-gray-700">Modelo</label>
                    <div id="selectModelo" class="block w-full border rounded p-2"></div>
                    <span class="text-red-500 text-sm"><?php echo $modelo_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="patente" class="block text-gray-700">Patente</label>
                    <input type="text" name="patente" class="block w-full border rounded p-2 <?php echo (!empty($patente_err)) ? 'border-red-500' : ''; ?>" value="<?php echo $patente; ?>">
                    <span class="text-red-500 text-sm"><?php echo $patente_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="institucional" class="block text-gray-700">Institucional</label>
                    <input type="text" name="institucional" class="block w-full border rounded p-2 <?php echo (!empty($institucional_err)) ? 'border-red-500' : ''; ?>" value="<?php echo $institucional; ?>">
                    <span class="text-red-500 text-sm"><?php echo $institucional_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="ano" class="block text-gray-700">Año</label>
                    <input type="text" name="ano" class="block w-full border rounded p-2 <?php echo (!empty($ano_err)) ? 'border-red-500' : ''; ?>" value="<?php echo $ano; ?>">
                    <span class="text-red-500 text-sm"><?php echo $ano_err; ?></span>
                </div>

                <div class="mb-4">
                    <label for="unidad" class="block text-gray-700">Unidad (*)</label>
                    <div class="search-box">
                        <input type="text" class="block w-full border rounded p-2" autocomplete="off" placeholder="Buscar unidad..." />
                        <input type="text" name="unidad" class="block w-full border rounded p-2 <?php echo (!empty($unidad_err)) ? 'border-red-500' : ''; ?>" value="<?php echo $unidad; ?>">
                        <div class="result"></div>
                    </div>
                    <span class="help-block"><?php echo $unidad_err; ?></span>
                </div>

                <div class="flex items-center justify-between">
                    <input type="submit" class="bg-blue-500 text-white py-2 px-4 rounded" value="Registrar Vehículo">
                    <a href="index.php" class="text-blue-500">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>