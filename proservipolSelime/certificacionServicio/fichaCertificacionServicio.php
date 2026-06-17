<?session_start();
//if ($_SESSION['USUARIO_USERNAME'] == "" || ($_SESSION['USUARIO_CODIGOPERFIL'] !=70 && $_SESSION['USUARIO_CODIGOPERFIL'] !=80)) header("location:index.php");
?>
<?php
$codigoPerfil   = $_SESSION['USUARIO_CODIGOPERFIL'];
$unidadUsuario  = $_SESSION['USUARIO_CODIGOUNIDAD'];
$codigoUsuario  = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];

$descripcionUnidad  = $_GET['descripcionUnidad'];
$fechaServicios     = $_GET["fechaServicios"];
$unidadServicios    = $_GET["unidadServicios"];

/*

$codigoPerfil = 70;
$unidadUsuario = 459;
$codigoUsuario  = '921694M';

*/

//echo "codigoPerfil ---> " . $codigoPerfil;
?>

<html>
<head>
<title>Ficha Servicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/verdeStyle.css" rel="stylesheet" type="text/css">
<link href="./css/fichaCertificacionServicio.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/serviciosCertificado.js"></script>
<script type="text/javascript" src="./js/numero.js"></script>
</head>

<body leftmargin="12" topmargin="10" marginwidth="0" marginheight="0" bgcolor="#d0d0d0" scroll="no">
<div style="width:100%; height:450px; overflow-y: none; scrollbar-track-color:#d0d0d0; scrollbar-face-color:#d0d0d0;padding:0px 2px 0px 2px;"> 	
<input type="hidden" id="tipoServicio">

<!--
<div id="resumenServicios">
<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Cargando Resumen Servicios ......</td></tr></table>
</div>
-->

<table width="100%">
<tr>
	<td align="left" width="80%"><div id="datosValidacion"></div></td>
    <td align="right" width="20%">
	    <table border="0" width="100%">
		<tr>
	    <td onmouseover="this.style.cursor='hand'" align="right" onClick="cambiaLayer('layerResumenServicio')">VER RESUMEN</td>
		<td width="1%" align="center">|</td>
		<td onmouseover="this.style.cursor='hand'" onClick="cambiaLayer('layerListadoServicio')">VER SERVICIOS</td>
	    </tr>
		</table>
    </td>
</tr>
</table>
<div class="linea"></div>
<!--
<table width="100%">
<tr>
   <td align="right" width="15%"><div id="imprimeServicio"></div></td>
</tr>
</table>
-->


		<div id="listado2">

<div id="layerResumenServicio" style="position:absolute; width:100%; visibility:visible;">
	<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Cargando Resumen ...</td></tr></table>
</div>



<div id="layerListadoServicio" style="position:absolute; width:100%; visibility:hidden;">
    <div id="cabeceraGrilla">
    <table cellspacing="1" cellpadding="1" width="100%">
      <tr> 
        <td id="nombreColumna" width="5%" align="center">N°</td>
        <td id="nombreColumna" width="60%" align="center">SERVICIO</td>
        <td id="nombreColumna" width="15%" align="center">HORARIO</td>
        <td id="nombreColumna" width="10%" align="center">FUN.</td>
        <td id="nombreColumna" width="10%" align="center">VEH.</td>
      </tr>
    </table>
    </div>
    <div id="listadoServicios">
    <table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ...</td></tr></table>
    </div>
</div>




<div id="layerDetalleServicio" style="position:absolute; width:100%; visibility:hidden;">
    <div id="identificacionServicio" style="width:100%"></div>

    <div id="mediosDeVigilancia" style="width:100%"></div>

    <div id="observaciones" style="width:100%"></div>
</div>




</div>






</div>



</div>

<div class="linea"></div>
<table align="center" width="100%">
<tr> 
  <td width="30%">
  	<input type="button" id="btnImprimir" name="btnImprimir" value="CREAR PDF TOTALIDAD DE SERVICIOS" class="Boton_100" onclick="window.open('../imprimible/servicios/servicioFechaUnidad.php?codigoUnidad=<?echo $unidadServicios;?>&fecha1=<?echo $fechaServicios;?>');">
  </td>
  <td width="20%"><div id="imprimirServicioActual"></div></td>
  <td width="15%"></td>
  <td width="15%">
  	<input type="button" id="btnValidar" name="btnValidar" value="VALIDAR" class="Boton_100" onclick="validaServicios('<?echo $unidadServicios;?>','<?echo $fechaServicios;?>','<?echo $codigoUsuario;?>');" disabled></td>
  <td width="20%"><input type="button" id="btnCerrar" name="btnCerrar" value="CANCELAR" class="Boton_100" onclick="top.cerrarVentana();"></td>
</tr>
</table>
</body>
</html>

<?
	echo "<script>\n";
	echo "leeDatosServicios('".$codigoPerfil."','".$codigoUsuario."','".$unidadUsuario."','".$unidadServicios."','".$fechaServicios."','".$descripcionUnidad."');\n";
	echo "</script>\n";
?>


