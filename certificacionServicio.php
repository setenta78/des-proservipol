<?
include("version.php");
include("session.php");
include("tiempo.php");
$codPerfil	= $_SESSION['USUARIO_CODIGOPERFIL'];
$unidadUsuario  = $_SESSION['USUARIO_CODIGOUNIDAD'];
$descripcionUnidadUsuario  = $_SESSION['USUARIO_DESCRIPCIONUNIDAD'];
$mes = DATE(n);
$anno = DATE(Y);
$codPadre = $_SESSION['USUARIO_CODIGOPERFIL'];
$tipoUnidad = $_SESSION['USUARIO_TIPOUNIDAD'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="./certificacionServicio/css/certificacionServicio.css?v=<?echo version?>">
<script language="javascript" SRC="./certificacionServicio/js/creaObjeto.js?v=<?echo version?>"></script>
<script language="javascript" SRC="./certificacionServicio/js/funcionesCertificacionServicio.js?v=<?echo version?>"></script>
<script language="javascript" SRC="./certificacionServicio/js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/vehiculos.js?v=<?echo version?>"></script>  
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?include("header.php")?>
</head>
<body onload="actualizarTamanoLista2('listado2');" onresize="actualizarTamanoLista2('listado2');">
<div id="cubreFondo" style="display:none;"></div>
<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
<div id="titulo">Certificaci&oacute;n Servicios</div>
<div id="subtitulo">Selecciones mes y a&ntilde;o para ver el estado de validaci&oacute;n de los Servicios.</div>
<div style="height:68px"></div>
<table width="100%">
	<tr>
		<td width="3%">&nbsp;</td>
		<td align="right" width="5%">UNIDAD&nbsp;:&nbsp;<input type="hidden" value="<?echo $unidadBloqueada?>" id="textUnidadBloqueada" name="textUnidadBloqueada"/><input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite" id="textFechaLimite"/><input id="textBuscar" type="hidden" readonly="yes" value="<?echo $fechaHoy?>"></td>
		<td width="20%"><select class="campoSelect" id="selUnidad" name="selUnidad"><option value="0"></option></select></td>
		<td align="right" width="5%">MES&nbsp;:&nbsp;</td>
		<td width="10%">
			<select class="campoSelect" id="selMes" name="selMes">
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
		<td align="right" width="5%">A&Ntilde;O&nbsp;:&nbsp;</td>
		<td width="8%">
			<select class="campoSelect" id="selAnno" name="selAnno" onChange="selMes.value=1;">
				<? for($i=(date("Y")-3);$i<=date("Y");$i++) echo "<option value='".$i."'>".$i."</option>"; ?>
			</select>
		</td>
		<td width="3%"></td>
		<td width="10%"><input class="Boton_100" type="button" id="btnCargaDatos" value="CONSULTAR" onclick="verificaIngresoDatos(selMes.value,selAnno.value,selUnidad.value);"></td>
		<td width="3%"></td>
		<td width="10%"><input class="Boton_100" type="button" id="btnCargaDatos" value="INFORME VALIDACIONES" onclick="abrirInforme()"></td>
		<td width="5%"></td>
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
	<table width="100%"><tr class="linea"><td></td></tr></table>
</div>
</div>
<? include("modal-popup.php"); ?>
</body>
</html>
<?
echo "<script>";
if($permisoRegistrar || $permisoValidar) echo "fallaPospuesta();";
echo "document.getElementById('selUnidad').options[0] = new Option('".$descripcionUnidadUsuario."','".$unidadUsuario."','','');";
echo "verificaIngresoDatos(".$_SESSION['FECHA_LIMITE_M'].",".$_SESSION['FECHA_LIMITE_Y'].",".$unidadUsuario.");";
echo "document.getElementById('selUnidad').value = ".$unidadUsuario.";";
echo "document.getElementById('selMes').value = ".$_SESSION['FECHA_LIMITE_M'].";";
echo "document.getElementById('selAnno').value = ".$_SESSION['FECHA_LIMITE_Y'].";";
echo "</script>";
?>