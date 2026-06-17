<?
include("session.php");
include("tiempo.php");

$codigoFuncionario 		= $_GET["codigoFuncionario"];
$codigoColor			 		= $_GET["codColor"];
$codigoFolio			 		= $_GET["codFolio"];

$unidadUsuario	   		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
$tienePlanCuadrante		= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
$unidadPadre		    	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad			      = $_SESSION['USUARIO_TIPOUNIDAD']; //Variable de sesion añadida el 14-09-2015
$ip										= $_SESSION['DIRECCION_IP'];
$fecha                 = date("Y-m-d");
?>
<html>
<head>
<title>LICENCIAS MEDICAS ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script> 
<script type="text/javascript" src="./js/licenciaMedica.js?1.0.0"></script>

<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaServicio.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0" scroll="no" onload="cargaEspecialidades();buscaDatosFichaLicencia(); servicioLicenciaCorrelativo();">
	
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="cargoBaseDatos" type="hidden" readonly="yes">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codCuadranteBaseDatos" type="hidden" readonly="yes">
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="origenBaseDatos">	
<input type="hidden" id="IpFuncionario" name="IpFuncionario" value="<? echo $ip; ?>">
<input type="hidden" id="unidadFuncionario" name="unidadFuncionario" value="">
<input type="hidden" id="codigoFuncionario" name="codigoFuncionario" value="<? echo $codigoFuncionario; ?>">
<input type="hidden" id="correlativo" name="correlativo" value="">
<input id="fecha"  type="hidden" readonly="yes" value="<?echo $fecha?>">
<input type="hidden" id="fechaTerminoInicial" name="fechaTerminoInicial" value="">
<input type="hidden" id="servicio" name="servicio" value="">
<input type="hidden" id="correlativoAnticipado" name="correlativoAnticipado" value="">
<input type="hidden" id="fechaTerminoReal" name="fechaTerminoReal" value="">

<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="marcoLevantado">
<br>
<div id="seccion2">
<div id="seccion1" align="right">
<table id="tabla1" border="0" >
<tr>
<td align="right"><b> FOLIO:</b></td>	
<td>
<select id="Listcolor" name="Listcolor" disabled="disabled">	
	<option value="">SELECCIONE UNA OPCION ...</option>
	<option value="AA">LICENCIA INSTITUCIONAL</option>
	<option value="B">LICENCIA DIPRECA</option>
	<option value="N">LICENCIA ARMADA</option>
	<option value="E">LICENCIA EJERCITO</option>
	<option value="F">LICENCIA FACH</option>
	<option value="1">LICENCIA FONASA / FONASA</option>
	<option value="3">LICENCIA HOSPITAL PUBLICO O MEDICO EXTERNO</option>
	<option value="PP">PERMISO POSTNATAL PARENTAL</option>
	<option value="MP">RESOLUCIÓN MEDICINA PREVENTIVA</option> 
</select>
<input type="hidden" id="txtcolor" name="txtcolor" size="1" style="text-transform:uppercase;" value="<? echo $codigoColor; ?>" readonly="yes">
</td>
<td><b></b></td>
<td><input type="text" id="txtfolio" name="txtfolio" size="14" value="<? echo $codigoFolio; ?>" readonly="yes" ></td>
</tr>
</table>
</div>
<u><b>SECCION A: USO Y RESPONSABILIDAD EXCLUSIVA DEL PROFESIONAL</b></u>
<br><br>
<fieldset>
<legend><b>A.1 IDENTIFICACION DEL TRABAJADOR</b></legend>
<br>
<table id="tabla2" width="90%" border="0">
<tr>
<td align="center"><input type="text" id="txtape1" name="txtape1" size="15" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtape2" name="txtape2" size="15" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtnom" name="txtnom" size="20" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtrut" name="txtrut" value="" size="15" onKeypress="maximo(this,9,'R')" onblur="formato_rut(this)" readonly="yes"></td>
<td><img src="img/busqueda.png"  width="23" height="23" alt="Consultar Datos ..."/></td>
<td rowspan="6"><img id="fotoFuncionario" width="121" height="119" align="left" src="./img/sinFoto.png" onerror="this.src='./img/sinFoto.png'"></td>
</tr>
<tr>
<td align="center">APELLIDO PATERNO</td>
<td align="center">APELLIDO MATERNO</td>
<td align="center">NOMBRES</td>
<td align="center"> RUN </td>
<td></td>
</tr>
<tr>
<td align="center"><input type="text" id="txtfec1" name="txtfec1" size="10" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(txtfec1, txtfec1,'dd-mm-yyyy','300','-1');" disabled="disable"></td>
<td align="center"><input type="text" id="txtfec2" name="txtfec2" size="10" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(txtfec2, txtfec2,'dd-mm-yyyy','300','-1');" disabled="disable"></td>
<td align="center"><input type="text" id="textFechaTermino" name="textFechaTermino" size="10" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaTermino, textFechaTermino,'dd-mm-yyyy','300','-1');" disabled="disable"></td>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"> FECHA OTORGAMIENTO</td>
<td align="center"> FECHA INICIO REPOSO</td>
<td align="center"> FECHA TERMINO REPOSO</td>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"><input type="text" id="txtdias" name="txtdias" size="2" onKeypress="maximo(this,2,'N')" readonly="yes"></td>
<td align="center"><input type="text" id="fechaReal" name="fechaReal" size="10" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(fechaReal, fechaReal,'dd-mm-yyyy','300','-1');" disabled="disable"></td>
<td align="center"><input type="text" id="txtfecF" name="txtfecF" size="10" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13"  onClick="popUpCalendar(txtfecF, txtfecF,'dd-mm-yyyy','300','-1');" ></td>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"> N° DE DIAS</td>
<td align="center"> FECHA REAL INICIO <!-- <input type="checkbox" id="optionInicio" name="optionInicio" onclick="inicioReal();">--></td>
<td align="center">FECHA TERMINO ANTICIPADO (*)</td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>
</div>

<br>
<div id="seccion3">
<fieldset>
<legend><b>A.2 TIPO LICENCIA</b></legend>
<br>
<table id="tabla4" border="0">
<tr>
<td><select id="cboLicencia" onchange="hijomenor()" disabled="disabled">
  <option value="0">SELECCIONE UNA OPCION ...</option>
  <option value="633">ENFERMEDAD O ACCIDENTE COMUN</option>
  <option value="632">PRORROGA MEDICINA PREVENTIVA</option>
  <option value="170">LICENCIA MATERNAL PRE NATAL</option>
  <option value="180">LICENCIA MATERNAL POST NATAL</option>
  <option value="162">ENFERMEDAD GRAVE HIJO MENOR DE UN AÑO</option>
  <option value="718">ACCIDENTE EN ACTO DE SERVICIO</option>
  <option value="630">ENFERMEDAD PROFESIONAL</option>
  <option value="631">PATOLOGIA DEL EMBARAZO</option>
  <option value="849">LICENCIA MEDICA PREVENTIVA PARENTAL</option>
</select></td>
<td>&nbsp;&nbsp;<b>(*) RECUPERABILIDAD LABORAL:</b></td>
<td>SI</td>
<td><input type="radio" id="optionRecup1" name="optionRecup" value=1 disabled="disabled"></td>
<td>NO</td>
<td><input type="radio" id="optionRecup2" name="optionRecup" value=2 disabled="disabled"></td>
</tr>
<tr>
<td></td>
<td>&nbsp;&nbsp;<b>(*) INICIO TRAMITE INVALIDEZ:</b></td>
<td>SI</td>
<td><input type="radio" name="optionInvalidez1" value="1" disabled="disabled"></td>
<td>NO</td>
<td><input type="radio" name="optionInvalidez2" value="2" disabled="disabled"></td>
</tr>
</table>
<br>
</fieldset>
</div>
<div id="seccion3a" style="display:none;">
<br>
<fieldset>
<legend><b> IDENTIFICACION DEL HIJO</b></legend>
<br>
Solo para licencias por enfermedad grave hijo menor de un año y post natales (Art. 199 y 200 del C. del trabajo) y juicio de adopcion plena (Ley 18.867)
<br><br>
<table id="tabla3" border="0">
<tr>
<td align="center"><input type="text" id="txtruth" name="txtruth" size="15" onKeypress="maximo(this,9,'R')" onblur="formato_rut(this)" readonly="yes" ></td>
<td align="center"><input type="text" id="txtfec3" name="txtfec3" size="10" value="" readonly="yes" ></td>
<td><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(txtfec3, txtfec3,'dd-mm-yyyy','300','-1');"></td>
</tr>
<tr>
<td align="center">RUN</td>
<td align="center">FECHA DE NACIMIENTO</td>
<td></td>
</tr>
</table>
</fieldset>
</div>
<br>
<div id="seccion4">
<fieldset>
<legend><b>A.3 CARACTERISTICAS DEL REPOSO</b></legend>
<br>
<table id="tabla5" border="0">
<tr>
<td><select id="cboReposo" disabled="disabled">
  <option value="0">SELECCIONE UNA OPCION ...</option>
  <option value="1">REPOSO LABORAL TOTAL</option>
  <option value="2">REPOSO LABORAL PARCIAL</option> 
</select></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>(*) LUGAR DE REPOSO:</b</td>
<td>DOMICILIO</td>
<td><input type="radio" id="optionReposo1" name="optionReposo" value="1" disabled="disabled"></td>
<td>HOSPITAL</td>
<td><input type="radio" id="optionReposo2" name="optionReposo" value="2" disabled="disabled"></td>
<td>OTRO</td>
<td><input type="radio" id="optionReposo3" name="optionReposo" value="3" disabled="disabled"></td>
</tr>
</table>
</div>
<br>
<div id="seccion5">
<fieldset>
<legend><b>A.4 IDENTIFICACION DEL PROFESIONAL</b></legend>
<br>
<table id="tabla6" border="0">
<tr>
<td align="center"><input type="text" id="txtrutp" name="txtrutp" size="15" readonly="yes"></td>
<td>

</td>

<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*) TIPO PROFESIONAL:</b>&nbsp;&nbsp;MEDICO<input type="radio" id="optionMed1" name="optionMed" value="1" disabled="disabled"></td>
<td>DENTISTA<input type="radio" id="optionMed2" name="optionMed" value="2" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;MATRONA<input type="radio"  id="optionMed3" name="optionMed" value="3" disabled="disabled"></td>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"><b> RUN PROFESIONAL</b></td>
<td></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>(*) ATENCION:</b> INSTITUCIONAL<input type="radio" name="optionAte1" value="1" disabled="disabled"></td>
<td>EXTRA INSTITUCIONAL</b><input type="radio" name="optionAte2" value="2" disabled="disabled"></td>
</tr>
<tr>
<td></td>	
<td></td>
<td></td>
<td></td>
</tr>
</table>
<br>
<div id="seccion5a">
<table>
<tr>
<td><b> ESPECIALIDAD PROFESIONAL</b></td>
<td>
</td>	
</tr>	
<tr>
<td align="center" id="EspecialidadList"><select id="cboEspecialidad">
<option value="0">SELECCIONE UNA OPCION ...</option>
</select></td>
<td></td>	
</tr>
</table>
</div>
<br>
</fieldset>
<br>
</div>
</div>
<br>
<table>
<tr align="left">
<form name="formSubeArchivo" action="adjuntarArchivoSubirLicencia.php" method="post" enctype="multipart/form-data" target="frameSubirArchivo">
<td><!--<input type="file" size="20" name="archivo" id="archivo" disabled/>--><input type="text" id="txtarchivo" name="txtarchivo" size="30" disabled></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>
	<!--<input type="button" value="SUBIR" id="btn100" name="btnSubir" onClick="subirArchivo(this)"/>-->
	<input type="hidden" id="archivoServidor" value="">
	<input type="hidden" id="archivoLoad" value=0>
	<input type="hidden" id="rutArchi" name="rutArchi" value="">
	</form> 
</td>
<td width="10%">&nbsp;</td>
<td width="10%">&nbsp;</td>
<td width="20%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="RECORTAR"  onClick="recortarLicencia()"></td>
<td width="20%"><input name="btnAnular" type="button" id="btn100" value="ANULAR"  onClick="modificarLicencia()"></td>
<td width="14%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();"></td>	
</tr>	
</table>
<div id="seccionMensaje">
<b><p id='Mensaje'></p></b>
</div>
</body>
</html>