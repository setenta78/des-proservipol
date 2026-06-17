<?
include("session.php");
//session_start();
//if ($_SESSION['USUARIO_USERNAME'] == "" || ($_SESSION['USUARIO_CODIGOPERFIL'] !=70 && $_SESSION['USUARIO_CODIGOPERFIL'] !=80)) header("location:index.php");
include("tiempo.php");

$codPerfil	 	 = $_SESSION['USUARIO_CODIGOPERFIL_PADRE'];
$unidadUsuario  = $_SESSION['USUARIO_CODIGOUNIDAD'];
//echo $unidadUsuario  = 4390;
$descripcionUnidadUsuario  = $_SESSION['USUARIO_DESCRIPCIONUNIDAD'];
$mes = DATE(n);
$anno = DATE(Y);
//$descripcionUnidadUsuario = utf8_encode($descripcionUnidadUsuario);
/*
$codigoPerfil = 70;
$unidadUsuario = 459;
$descripcionUnidadUsuario = '2DA. COM. SAN FELIPE (UNIDAD BASE)';
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="./certificacionServicio/css/certificacionServicio.css">
<script language="javascript" SRC="./certificacionServicio/js/creaObjeto.js"></script>
<script language="javascript" SRC="./certificacionServicio/js/funcionesCertificacionServicio.js"></script>
<script language="javascript" SRC="./certificacionServicio/js/horaFecha.js"></script>

<script type="text/javascript" src="./js/vehiculos.js"></script>  
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
</head>

<body onload="actualizarTamanoLista2('listado2');" onresize="actualizarTamanoLista2('listado2');">
<?include("header.php")?>
<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
<div id="titulo">Certificación Servicios</div>
<div id="subtitulo">Selecciones mes y año para ver el estado de validación de los Servicios.</div>
<div style="height:68px"></div>
<table width="100%">
	<tr>
		<td width="15%">&nbsp;</td>
		<td align="right" width="5%">UNIDAD&nbsp;:&nbsp;<input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada"/><input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite"/><input id="textBuscar" type="hidden" readonly="yes" value="<?echo $fechaHoy?>"></td>
		<td width="30%"><select class="campoSelect" id="selUnidad" name="selUnidad"><option value="0"></option></select></td>
		<td align="right" width="5%">MES&nbsp;:&nbsp;</td>
		<td width="12%">
			<select class="campoSelect" id="selMes" name="selMes">
				<option value="0"></option>
				<option value="1">ENERO</option>
				<option value="2">FEBRERO</option>
				<option value="3">MARZO</option>
				<option value="4">ABRIL</option>
				<option value="5">MAYO</option>
				<option value="6">JUNIO</option>
				<option value="7">JULIO</option>
				<option value="8">AGOSTO</option>
				<option value="9">SEPTIEMBRE</option>
				<option value="10">OCTUBRE</option>
				<option value="11">NOVIEMBRE</option>
				<option value="12">DICIEMBRE</option>
			</select>
		</td>
		<td align="right" width="5%">AÑO&nbsp;:&nbsp;</td>
		<td width="8%">
			<select class="campoSelect" id="selAnno" name="selAnno">
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				<option value="2021">2021</option>
			</select>
		</td>
		<td width="3%"></td>
		<td width="10%"><input class="Boton_100" type="button" id="btnCargaDatos" value="CONSULTAR" onclick="verificaIngresoDatos(selMes.value,selAnno.value,selUnidad.value);"></td>
	</tr>
</table>

<div style="height:25px"></div>
<div id='layerIngresoServicios' style="position:absolute;">
	<div id="listado2">
		<div id="cabeceraGrilla2">
		  <table cellspacing="1" cellpadding="1" width="100%">
	      <tr> 
	        <td id="nombreColumna" width="24%" align="center">UNIDAD</td>
	        <td id="nombreColumna" width="12%" align="center">FECHA</td>
	        <td id="nombreColumna" width="12%" align="center">ESTADO</td>
	        <td id="nombreColumna" width="38%" align="center">VALIDADO POR</td>
	        <td id="nombreColumna" width="14%" align="center">FECHA VALIDACION</td>
	      </tr>
	   	</table>
	  </div>
  	<div id="listadoIngresoServicios"></div>
  </div>
	<div style="height:2px"></div>
	<table width="98.3%"><tr class="linea"><td></td></tr></table>
</div>
</div>
</body>
</html>

<?php
//if($unidadUsuario==11830){
//	echo "<script>";
//	echo "document.getElementById('selUnidad').options[0] = new Option('RETEN BONILLA','11830','','')";
//  echo "</script>";
//}

if ($codPerfil == 10 || $codPerfil == 20 || $codPerfil == 45 || $codPerfil == 70 || $codPerfil == 80 || $codPerfil == 120)	echo "<script>fallaPospuesta();</script>";

if($codPerfil==70){
	echo "<script>";
	echo "buscaUnidades('".$unidadUsuario."');";
	echo "</script>";
} else if($codPerfil==80 || $codPerfil==10 || $codPerfil==20 || $codPerfil==90 || $codPerfil==100 || $codPerfil==180){
	echo "<script>";
	echo "document.getElementById('selUnidad').options[0] = new Option('".$descripcionUnidadUsuario."','".$unidadUsuario."','','')";
	echo "</script>";
}
	echo "<script>verificaIngresoDatos(".$mes.",".$anno.",".$unidadUsuario."); document.getElementById('selUnidad').value = ".$unidadUsuario."; document.getElementById('selMes').value = ".$mes."; document.getElementById('selAnno').value = ".$anno.";</script>";

?>
