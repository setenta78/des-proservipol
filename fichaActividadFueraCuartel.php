<?
include("version.php");
include("session.php");
include("tiempo.php");
$codActividad 		= $_GET["codActividad"];
$codigoUnidad		= $_GET["codUnidad"];
$fechaCierre		= $_GET["fechaCierre"];
$unidadUsuario	   	= $_SESSION['USUARIO_CODIGOUNIDAD']; 
$tienePlanCuadrante	= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
$unidadPadre		= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad			= $_SESSION['USUARIO_TIPOUNIDAD'];
$ip					= $_SESSION['DIRECCION_IP'];
$codPerfil	 	 	= $_SESSION['USUARIO_CODIGOPERFIL'];
$usuario		 	= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
$fecha              = date("Y-m-d");

?>
<html>
<head>
<title>COMISION DE SERVICIO</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/actividadFueraCuartel.js?v=<?echo version?>" charset="utf-8"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaActividadFueraCuartel.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
</head>
<body style="margin-top:10; margin-left:10; background-color:#f5fbf3" scroll="no" onload="rutUsuario(); tipoFicha('<? echo $codActividad; ?>','<? echo $codigoUnidad; ?>');">
<input id="idFuncionario" name="idFuncionario" type="hidden" readonly="yes">
<input id="unidadUsuario" type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input type="hidden" id="origenBaseDatos">
<input type="hidden" id="txtCodigoActividad" name="txtCodigoActividad" value="<? echo $codActividad ?>">
<input type="hidden" id="IpFuncionario" name="IpFuncionario" value="<? echo $ip; ?>">
<input type="hidden" id="unidadFuncionario" name="unidadFuncionario" value="">
<input type="hidden" id="usuario" name="usuario" value="<?echo $usuario?>">
<input type="hidden" id="correlativo" name="correlativo" value="">
<input id="fecha" type="hidden" readonly="yes" value="<?echo $fecha?>">
<input type="hidden" id="rutUsuario" name="rutUsuario" value="">
<input type="hidden" id="FechaCierre" name="FechaCierre" value="<? echo $fechaCierre; ?>">
<input type="hidden" id="FechaRegistro" name="FechaRegistro" value="">
<input type="hidden" id="FechaFinalReal" name="FechaFinalReal" value="">
<input type="hidden" id="UltimoEstado" name="UltimoEstado" value="">
<input id="perfil" type="hidden" readonly="yes" value="<?echo $codPerfil?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="marcoLevantado">
<br>
<div id="seccion2">
<u><b>USO Y RESPONSABILIDAD EXCLUSIVA DEL PROFESIONAL</b></u>
<div id="seccion1" align="right">
<br>
</div>
<fieldset>
<legend><b>IDENTIFICACIÓN DEL TRABAJADOR</b></legend>
<br>
<table id="tabla2" width="90%" border="0">
<tr>
<td align="center"><input type="text" id="txtape1" name="txtape1" size="15" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtape2" name="txtape2" size="15" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtnom" name="txtnom" size="20" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtrut" name="txtrut" autocomplete="off" value="" size="15" maxlength="9" onKeypress="return solo_rut(event)" onblur="formato_rut(this);"></td>
<td><img src="img/busqueda.png"  width="23" height="23" alt="Consultar Datos ..."/></td>
<td rowspan="4"><img id="fotoFuncionario" width="121" height="119" align="left" src="./img/sinFoto.png" onerror="this.src='./img/sinFoto.png'"></td>
</tr>
<tr>
<td align="center">PRIMER APELLIDO</td>
<td align="center">SEGUNDO APELLIDO</td>
<td align="center">NOMBRES</td>
<td align="center"><? echo (!$codActividad) ? "(*)" : ""; ?> RUN </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<tr>
<td align="center"><input type="text" id="txtfec1" name="txtfec1" size="10" value="" readonly="yes">&nbsp;<input id="idFechaServicio1" name="idFechaServicio1" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtfec1,'dd-mm-yyyy',this,-100,-75);" <? if($codActividad!="") echo 'disabled="disabled"'; ?> ></td>
<td align="center"><input type="text" id="txtfec2" name="txtfec2" size="10" value="" readonly="yes">&nbsp;<input id="idFechaServicio2" name="idFechaServicio2" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtfec2,'dd-mm-yyyy',this,-100,-75);" <? if($codActividad!="") echo 'disabled="disabled"'; ?> ></td>
<td align="center"><? if($codActividad!="") echo '<input type="text" id="txtFechaTerminoReal" name="txtFechaTerminoReal" size="10" value="" readonly="yes">&nbsp;<input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtFechaTerminoReal,\'dd-mm-yyyy\',this,-100,-195);" >'; ?> </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><? echo (!$codActividad) ? "(*)" : ""; ?> FECHA INICIO</td>
<td align="center"><? echo (!$codActividad) ? "(*)" : ""; ?> FECHA TERMINO</td>
<td align="center"><? echo ($codActividad) ? "(*) FECHA TERMINO ANTICIPADO" : ""; ?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
</fieldset>
<br>
</div>
<br>
<div id="seccion3">
<fieldset>
<legend><b>TIPO ACTIVIDAD FUERA CUARTEL</b></legend>
<br>
<table id="tabla4" border="0">
<tr>
<td>&nbsp;</td>
<td><select id="cboTipo" onchange="cambioTipoFicha()" >
  <option value="0">SELECCIONE UNA OPCION ...</option>
  <option value="867">COMISIÓN DE SERVICIO</option>
</select></td>
<td width="25%" >&nbsp;</td>
<td><div id="numComision" style="display:none;">Número de Resolución:&nbsp;<input type="text" id="txtComision" name="txtComision" value="" ></div></td>
</tr>
</table>
<br>
</fieldset>
</div>
<br>
<table>
<tr>
<td>&nbsp;<div style="position: absolute; top: 70%;">(*) Indicar fecha en caso de un termino anticipado de la comisión de servicio</div></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td width="25%">&nbsp;</td>
<td width="25%"><input name="btnSuspenderActividad" type="button" id="btnSuspenderActividad" value="TERMINO ANTICIPADO" onClick="suspenderActividad()" ></td>
<td width="25%">
	<input name="btnGuardarActividad" type="button" id="btnGuardarActividad" value="GUARDAR" onClick="guardarActividad()">
	<input name="btnAnularActividad" type="button" id="btnAnularActividad" value="ANULAR" onClick="anularActividad()">
</td>
<td width="25%"><input name="btnCerrarFichaFuncionario" type="button" id="btnCerrarFichaFuncionario" value="CERRAR" onClick="top.cerrarVentana();"></td>
</tr>	
</table>
<div id="seccionMensaje">
<b><p id='Mensaje'></p></b>
</div>
</body>
</html>