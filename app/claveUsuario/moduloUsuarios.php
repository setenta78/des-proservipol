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
<html>
<head>
<!-- AJAX -->
<script type="text/javascript" src="./moduloUsuarios/js/creaObjeto.js"></script>

<!-- Funciones -->
<script type="text/javascript" src="./moduloUsuarios/js/funcionesServicio.js"></script>

<!-- CSS -->
<link href="./moduloUsuarios/css/moduloUsuarios.css" rel="stylesheet" type="text/css">


<!-- Popup Prototype -->
<script type="text/javascript" src="./moduloUsuarios/ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./moduloUsuarios/ventana/js/window.js"> </script>
<script type="text/javascript" src="./moduloUsuarios/ventana/js/effects.js"> </script>
<script type="text/javascript" src="./moduloUsuarios/ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./moduloUsuarios/ventana/js/debug.js"> </script>
<link href="./moduloUsuarios/ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./moduloUsuarios/ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./moduloUsuarios/ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>

</head>



<body onload="actualizarTamanoLista2('listado');" onresize="actualizarTamanoLista2('listado');">

<div class='barra_superior'>
    <div class="derecha">
        <form name="salir" method="post" action="logout.php">
        
        </form>
    </div>


    <?php
    echo "<b>MODULO USUARIOS PROSERVIPOL V3.9<br><br>";
    ?>

	<div>
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
		</div>

<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">Usuarios</div>
		<div id="subtitulo">Seleccione la acción deseada para gestionar los usuarios.</div>
		<div style="height:25px"></div>


      <table width="58.3%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        
        <td align="left" width="25%">

        <input class="Boton_100" type="button" id="btnFichaFuncionario" value="BUSCAR FUNCIONARIO" onclick="abrirVentana('./moduloUsuarios/fichaFuncionario.php');">

        </td>


        
        <td width="2%">&nbsp;</td>
        
        <td align="left" width="25%">
        <input class="Boton_100" type="button" id="btnBuscaUnidad" value="BUSCAR UNIDAD" onclick="abrirVentana('./moduloUsuarios/listaUnidades.php?unidadUsuario=<?php echo $_SESSION["USUARIO_CODIGOUNIDAD"]; ?>&descUnidadUsuario=<?php echo $_SESSION["USUARIO_DESCRIPCIONUNIDAD"]; ?>');">
        </td>

        <td align="left" width="25%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="Boton_100" type="button" id="btnFichaFuncionario" value="SUBROGANTE" onclick="abrirVentana('./moduloUsuarios/fichaSubrogante.php');"></td>

      </tr>
      </table>

		<div style="height:2px"></div>
		<table width="98.5%"><tr class="linea" ><td></td></tr></table>

		<div style="height:2px"></div>

		<div id="subtitulo2"><label id="labelUnidad">&nbsp;</label></div>

		<div style="height:2px"></div>


		
		<div id="listado">
			<div id="cabeceraGrilla">

              <table cellspacing="1" cellpadding="1" width="100%">
                <tr> 
                  <td id="nombreColumna" width="5%" align="center">No.</td>
                  <td id="nombreColumna" width="9%" align="center">CODIGO</td>
                  <td id="nombreColumna" width="13%" align="center">GRADO</td>
                  <td id="nombreColumna" width="23%" align="center">NOMBRE</td>
                  <td id="nombreColumna" width="15%" align="center">MODULO</td>
                  <td id="nombreColumna" width="23%" align="center">USUARIO</td>
                  <td id="nombreColumna" width="12%" align="center">FECHA</td>
                </tr>
             </table>


		   </div>
		   
		   
      <div id="listadoUsuarios"></div>

</div>


			<div style="height:2px"></div>
			<table width="98.5%"><tr class="linea"><td></td></tr></table>




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
