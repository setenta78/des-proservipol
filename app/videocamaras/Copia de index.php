<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type="text/css" rel="shortcut icon" href="img/logo-mywebsite-urian-viera.svg" />
  <title>Sistema de Importación de Datos: SAP -> PROSERVIPOL.</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/cargando.css">
  <link rel="stylesheet" type="text/css" href="css/cssGenerales.css">
</head>

<body>
  <div class="cargando">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light navbar-dark fixed-top" style="background-color: #2a5f42 !important;">
    <ul class="navbar-nav mr-auto collapse navbar-collapse">
      <li class="nav-item active">
        <a href="index.php">
          <img src="img/logobanner.png" alt="Web Developer CPR Daniela Parra" width="120">
        </a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
      <h5>Departamento Control de Gestón </br>Sistemas de Información</h5>
    </div>
  </nav>

  <div class="container">
    <h3 class="text-center">
      Sistema de Importación de Datos: SAP -> PROSERVIPOL.
    </h3>
    <hr>
    <br><br>
    <div class="row">
      <div class="col-md-7">
        <form action="queries/recibe_excel_validando.php" method="POST" enctype="multipart/form-data" />
        <div class="file-input text-center">
          <input type="file" name="dataCamara" id="file-input" class="file-input__input" />
          <label class="file-input__label" for="file-input">
            <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
            <span>Elegir Archivo Excel</span></label>
        </div>
        <div class="text-center mt-5">
          <input type="submit" name="subir" class="btn-enviar" value="Subir Excel" />
        </div>
        </form>
      </div>
    </div>
    <hr>
    <br><br>
    <?php
    require_once "queries/config.php";
    // require_once "queries/queries.php";

    $sql = "SELECT 
                VIDEOCAMARA.VC_CODIGO,
                VIDEOCAMARA.UNI_CODIGO,
                VIDEOCAMARA.VC_COD_ACTIVO_SAP,
                VIDEOCAMARA.VC_COD_EQUIPO_SAP,
                VIDEOCAMARA.VC_NRO_SERIE,
                MARCA_VIDEOCAMARA.MVC_CODIGO,
                MARCA_VIDEOCAMARA.MVC_DESCRIPCION,
                MODELO_VIDEOCAMARA.MODVC_CODIGO,
                MODELO_VIDEOCAMARA.MODVC_DESCRIPCION,
                PROCEDENCIA_RECURSO.PREC_CODIGO,
                PROCEDENCIA_RECURSO.PREC_DESCRIPCION
              FROM
                VIDEOCAMARA
                INNER JOIN MODELO_VIDEOCAMARA ON (VIDEOCAMARA.MODVC_CODIGO = MODELO_VIDEOCAMARA.MODVC_CODIGO)
                INNER JOIN MARCA_VIDEOCAMARA ON (VIDEOCAMARA.MVC_CODIGO = MARCA_VIDEOCAMARA.MVC_CODIGO)
                INNER JOIN PROCEDENCIA_RECURSO ON (VIDEOCAMARA.PREC_CODIGO = PROCEDENCIA_RECURSO.PREC_CODIGO)
              ORDER BY
                VC_CODIGO
              LIMIT 100";
    $i = 1;
    if ($result = mysqli_query($link, $sql)) {
      $total_cam = mysqli_num_rows($result);
      if (mysqli_num_rows($result) > 0) {
        echo "<h6 class='text-center'> Listado Cámaras Registradas <strong> (" . $total_cam . ") </strong> </h6>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nro.</th>";
        echo "<th>Código</th>";
        echo "<th>Marca</th>";
        echo "<th>Modelo</th>";
        echo "<th>Procedencia</th>";
        echo "<th>Unidad</th>";
        echo "<th>Código Activo</th>";
        echo "<th>Código Equipo</th>";
        echo "<th>Número Serie</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $i . "</td>";
          echo "<td>" . $row['VC_CODIGO'] . "</td>";
          echo "<td>" . $row['MVC_DESCRIPCION'] . "</td>";
          echo "<td>" . $row['MODVC_DESCRIPCION'] . "</td>";
          echo "<td>" . $row['PREC_DESCRIPCION'] . "</td>";
          echo "<td>" . $row['UNI_CODIGO'] . "</td>";
          echo "<td>" . $row['VC_COD_ACTIVO_SAP'] . "</td>";
          echo "<td>" . $row['VC_COD_EQUIPO_SAP'] . "</td>";
          echo "<td>" . $row['VC_NRO_SERIE'] . "</td>";
          echo "</tr>";
          $i = $i + 1;
        }
        echo "</tbody>";
        echo "</table>";
        mysqli_free_result($result);
      } else {
        echo "<p><em>No existen registros.</em></p>";
      }
    } else {
      echo "ERROR: No se pudo ejecutar la consulta $sql. " . mysqli_error($link);
    }
    mysqli_close($link);
    ?>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(window).load(function() {
        $(".cargando").fadeOut(1000);
      });
    });
  </script>

</body>

</html>