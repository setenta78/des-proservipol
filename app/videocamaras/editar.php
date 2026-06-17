<?php
require_once "queries/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    // Obtener datos del formulario
    $codigo = $_POST['codigo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $procedencia = $_POST['procedencia'];
    $unidad = $_POST['unidad'];
    $codigoActivo = $_POST['codigoActivo'];
    $codigoEquipo = $_POST['codigoEquipo'];
    $nroSerie = $_POST['nroSerie'];

    // Consulta para actualizar la cámara
    $sqlUpdate = "UPDATE VIDEOCAMARA SET 
                    MVC_CODIGO = '$marca', 
                    MODVC_CODIGO = '$modelo', 
                    PREC_CODIGO = '$procedencia', 
                    UNI_CODIGO = '$unidad', 
                    VC_COD_ACTIVO_SAP = '$codigoActivo', 
                    VC_NRO_SERIE = '$nroSerie' 
                  WHERE VC_CODIGO = '$codigo'";

    if (mysqli_query($link, $sqlUpdate)) {
        echo "<script>alert('Cámara actualizada correctamente'); window.location.href='index.php';</script>";
    } else {
        echo "ERROR: No se pudo ejecutar la consulta $sqlUpdate. " . mysqli_error($link);
    }
}

// Obtener el código de la cámara a editar
if (isset($_GET['id'])) {
    $codigo = $_GET['id'];

    // Consulta para obtener los datos actuales de la cámara
    $sql = "SELECT 
                VIDEOCAMARA.VC_CODIGO,
                MARCA_VIDEOCAMARA.MVC_CODIGO,
                MODELO_VIDEOCAMARA.MODVC_CODIGO,
                PROCEDENCIA_RECURSO.PREC_CODIGO,
                VIDEOCAMARA.UNI_CODIGO,
                VIDEOCAMARA.VC_COD_ACTIVO_SAP,
                VIDEOCAMARA.VC_COD_EQUIPO_SAP,
                VIDEOCAMARA.VC_NRO_SERIE
            FROM VIDEOCAMARA
            INNER JOIN MARCA_VIDEOCAMARA ON VIDEOCAMARA.MVC_CODIGO = MARCA_VIDEOCAMARA.MVC_CODIGO
            INNER JOIN MODELO_VIDEOCAMARA ON VIDEOCAMARA.MODVC_CODIGO = MODELO_VIDEOCAMARA.MODVC_CODIGO
            INNER JOIN PROCEDENCIA_RECURSO ON VIDEOCAMARA.PREC_CODIGO = PROCEDENCIA_RECURSO.PREC_CODIGO
            WHERE VIDEOCAMARA.VC_CODIGO = '$codigo'";

    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
} else {
    echo "<script>alert('Código no válido.'); window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Editar Cámara</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {

        $('.search-box input[type="text"]').on("keyup input", function() {
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("backend-search.php", {
                    term: inputVal
                }).done(function(data) {
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else {
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function() {
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>

<body>
    <div class="container mt-5">
        <h3 class="text-center">Editar Cámara</h3>
        <form action="editar.php" method="POST">
            <input type="hidden" name="codigo" value="<?php echo $row['VC_CODIGO']; ?>">

            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" name="marca" value="<?php echo $row['MVC_CODIGO']; ?>" required>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?php echo $row['MODVC_CODIGO']; ?>" required>
            </div>

            <div class="form-group">
                <label for="procedencia">Procedencia</label>
                <input type="text" class="form-control" name="procedencia" value="<?php echo $row['PREC_CODIGO']; ?>" required>
            </div>

            <div class="form-group">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" name="unidad" value="<?php echo $row['UNI_CODIGO']; ?>">
                <!--   <div class="search-box">
                    <input type="text" class="form-control" autocomplete="off" placeholder="Buscar unidad..." />
                    <div class="result"></div>
                    <input type="text" hidden="true" name="unidad" class="result" value="<?php echo $unidad; ?>">
                </div>-->
            </div>

            <div class="form-group">
                <label for="codigoActivo">Código Activo SAP</label>
                <input type="text" class="form-control" name="codigoActivo" value="<?php echo $row['VC_COD_ACTIVO_SAP']; ?>">
            </div>

            <div class="form-group">
                <label for="codigoEquipo">Código Equipo SAP</label>
                <input type="text" class="form-control" name="codigoEquipo" value="<?php echo $row['VC_COD_EQUIPO_SAP']; ?>" required>
            </div>

            <div class="form-group">
                <label for="nroSerie">Número de Serie</label>
                <input type="text" class="form-control" name="nroSerie" value="<?php echo $row['VC_NRO_SERIE']; ?>" required>
            </div>

            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>