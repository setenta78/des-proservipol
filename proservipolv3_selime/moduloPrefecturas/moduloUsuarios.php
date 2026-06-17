<?php
session_start();
if ($_SESSION["session_autent_ingreso"] == "SI")
{?>
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
        <input type="submit" name="CerrarSesion" id="CerrarSesion" value="SALIR" class="Boton_">
        </form>
    </div>


    <?php
    echo "<b>MODULO USUARIOS PROSERVIPOL V3.0 - PREFECTURAS<br><br>".strtoupper($_SESSION["session_nombre"])." (".strtoupper($_SESSION["session_login"]).") (".strtoupper($_SESSION["session_atrib"]).")</b>";
    ?>
</div>


<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">Usuarios</div>
		<div id="subtitulo">Seleccione la acción deseada para gestionar los usuarios.</div>
		<div style="height:25px"></div>


      <table width="98.3%" cellpadding="0" cellspacing="0">
      <tr>
        
        <td align="left" width="25%">

        <input class="Boton_100" type="button" id="btnFichaFuncionario" value="BUSCAR FUNCIONARIO" onclick="abrirVentana('./moduloUsuarios/fichaFuncionario.php');">

        </td>


        
        <td width="2%">&nbsp;</td>
        
        <td align="left" width="25%">
        <input class="Boton_100" type="button" id="btnBuscaUnidad" value="BUSCAR UNIDAD" onclick="abrirVentana('./moduloUsuarios/listaUnidades.php?unidadUsuario=<?php echo $_SESSION["USUARIO_CODIGOUNIDAD"]; ?>&descUnidadUsuario=<?php echo $_SESSION["USUARIO_DESCRIPCIONUNIDAD"]; ?>');">
        </td>

        <td width="48%">&nbsp;</td>

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
} else{ header("location: index.php?ingreso=error2"); }
?>